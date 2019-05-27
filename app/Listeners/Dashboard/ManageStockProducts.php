<?php

namespace App\Listeners\Dashboard;

use App\Customer;
use App\CustomerOrderItem;
use App\Events\Dashboard\CustomerOrderItemsAssigned;
use App\Product;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\StockMovementProductRepository;
use App\Repositories\Contracts\StockMovementRepository;
use App\Repositories\Contracts\StockProductRepository;
use App\StockMovement;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Database\Eloquent\Collection;

class ManageStockProducts
{
	use ValidatesResource;

	/**
	 * @var StockMovementRepository
	 */
	protected $stockMovements;

	/**
	 * @var StockMovementProductRepository
	 */
	protected $stockMovementProducts;

	/**
	 * @var StockProductRepository
	 */
	protected $stockProducts;

	/**
	 * @var CustomerRepository
	 */
	protected $customers;

	/**
	 * @var CustomerOrderRepository
	 */
	protected $customerOrders;

	/**
	 * @var ProductRepository
	 */
	protected $products;

	/**
	 * @var CustomerOrderItemRepository
	 */
	protected $customerOrderItems;

	/**
	 * @var StockMovement
	 */
	protected $currentStockReceiptMovement;

	/**
	 * @var StockMovement
	 */
	protected $currentStockCancellationMovement;

	/**
	 * Create the event listener.
	 *
	 * @param StockProductRepository $stockProducts
	 * @param CustomerRepository $customers
	 * @param CustomerOrderItemRepository $customerOrderItems
	 */
	public function __construct(
		StockMovementRepository $stockMovementRepository,
		StockMovementProductRepository $stockMovementProductRepository,
		StockProductRepository $stockProductRepository,
		CustomerRepository $customerRepository,
		CustomerOrderRepository $customerOrderRepository,
		ProductRepository $productRepository,
		CustomerOrderItemRepository $customerOrderItemRepository
	)
	{
		$this->stockMovements = $stockMovementRepository;
		$this->stockMovementProducts = $stockMovementProductRepository;
		$this->stockProducts = $stockProductRepository;
		$this->customers = $customerRepository;
		$this->customerOrders = $customerOrderRepository;
		$this->products = $productRepository;
		$this->customerOrderItems = $customerOrderItemRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param CustomerOrderItemsAssigned $event
	 *
	 * @return void
	 */
	public function handle(CustomerOrderItemsAssigned $event)
	{
		if (!$this->isValidResource($event->getResource())) {
			return;
		}

		$attributes = $event->getAttributes();
		$items = $event->getCustomerOrderItems();
		$order = $event->getCustomerOrder();

		/** @var Customer $customer */
		$customer = $this->customers->with('stock')->find($attributes['customer_id']);

		if ($items->count()) {

			if ($order->trashed()) {

				$this->freeForOrder($customer->stock->id, $order, $items);

			} else {

				$this->createReservesAndBackOrders($customer->stock->id, $order, $items);

			}
		}

		$order->touch();
	}

	protected function freeForOrder($stockId, $order, Collection $customerOrderItems)
	{
		list($active, , $trashed) = $this->groupOrderItemsByDeletedAt($customerOrderItems);

		/**
		 * @var integer $idx
		 * @var CustomerOrderItem $item
		 */
		foreach ($trashed as $idx => $item) {
			$this->freeStockProducts($stockId, $order, $item);
		}

		/**
		 * @var integer $idx
		 * @var CustomerOrderItem $item
		 */
		foreach ($active as $idx => $item) {
			$this->freeStockProducts($stockId, $order, $item);
		}
	}

	/**
	 * @param int $stockId
	 * @param Collection $customerOrderItems
	 */
	protected function createReservesAndBackOrders($stockId, $order, Collection $customerOrderItems)
	{
		list($active, $completed, $trashed) = $this->groupOrderItemsByDeletedAt($customerOrderItems);

		/**
		 * @var integer $idx
		 * @var CustomerOrderItem $item
		 */
		foreach ($trashed as $idx => $item) {
			$this->freeStockProducts($stockId, $order, $item);
		}

		/**
		 * @var integer $idx
		 * @var CustomerOrderItem $item
		 */
		foreach ($completed as $idx => $item) {
			$this->trashStockProducts($stockId, $order, $item);
		}

		/**
		 * @var integer $idx
		 * @var CustomerOrderItem $item
		 */
		foreach ($active as $idx => $item) {

			if ($item->bypass || $item->back_order) {

				$this->freeStockProducts($stockId, $order, $item);

				continue;
			}

			$available = $this->getAvailableProductsQuantity($stockId, $item);

			if ($available < $item->products_quantity) {

				/** @var CustomerOrderItem|null $backOrder */
				$backOrder = $this->createBackOrderForItem($stockId, $item, $available);

				$item = $this->updateOrderItem($item, $backOrder);
			}

			if ($item) {
				$this->reserveStockProducts($stockId, $order, $item);
			}
		}


	}

	/**
	 * @param Collection $items
	 *
	 * @return array
	 */
	protected function groupOrderItemsByDeletedAt(Collection $items)
	{
		$active = $items->filter(
			function ($item) {
				return $item->deleted_at === null && $item->status !== config('stock.status.invoice');
			}
		);

		$completed = $items->filter(
			function ($item) {
				return $item->deleted_at === null && $item->status === config('stock.status.invoice');
			}
		);

		$trashed = $items->filter(
			function ($item) {
				return $item->deleted_at !== null;
			}
		);

		return [$active, $completed, $trashed];
	}

	/**
	 * @param $stockId
	 * @param $order
	 * @param $item
	 */
	protected function freeStockProducts($stockId, $order, $item)
	{
		/** @var Collection $products */
		$products = $this->stockProducts->findAssembledProducts($stockId, $item);

		if ($products->count()) {

			$result = $this->stockProducts->freeProducts($products->pluck('id'));

			if ($result) {
				$this->registerStockMovementProductForItem(
					$stockId,
					'receipt',
					$item,
					$products,
					'order',
					$order->number
				);
			}
		}
	}

	/**
	 * @param $stockId
	 * @param $order
	 * @param $item
	 */
	protected function trashStockProducts($stockId, $order, $item)
	{
		/** @var Collection $products */
		$products = $this->stockProducts->findAssembledProducts($stockId, $item);

		if ($products->count()) {

			$this->stockProducts->trashProducts($products->pluck('id'));

		}
	}

	/**
	 * Reserve products in stock for the customer order item.
	 *
	 * @param int $stockId
	 * @param $item
	 */
	protected function reserveStockProducts($stockId, $order, $item)
	{
		/** @var Collection $products */
		$products = $this->stockProducts->findAssembledProducts($stockId, $item);

		/**
		 * Если товары для этой позиции частично зарезервированы
		 */
		if ($products->count()) {

			/**
			 * Если зарезервировано больше, чем надо.
			 */
			if ($products->count() > $item->products_quantity) {

				$diff = $item->products_quantity - $products->count();

				/** @var Collection $diffProducts */
				$diffProducts = $products->take($diff);

				$this->stockProducts->freeProducts($diffProducts->pluck('id'));

				$this->registerStockMovementProductForItem(
					$stockId,
					'receipt',
					$item,
					$diffProducts,
					'order',
					$order->number
				);
			}

			/**
			 * Если зарезервировано меньше, чем надо.
			 */
			if ($products->count() < $item->products_quantity) {

				$diff = $item->products_quantity - $products->count();

				/** @var Collection $diffProducts */
				$diffProducts = $this->stockProducts->findAvailableProducts($stockId, $item->product->id, $diff);

				$this->stockProducts->reserveProducts($diffProducts->pluck('id'), $item->id);

				$this->registerStockMovementProductForItem(
					$stockId,
					'cancellation',
					$item,
					$diffProducts,
					'order',
					$item->customerOrder->number
				);

			}

			/**
			 * Если одинаково, то не записываем stock_movement
			 */

		} else {

			if ($item->products_quantity) {

				/** @var Collection $products */
				$products = $this->stockProducts->findAvailableProducts(
					$stockId,
					$item->product->id,
					$item->products_quantity
				);

				$this->stockProducts->reserveProducts($products->pluck('id'), $item->id);

				$this->registerStockMovementProductForItem(
					$stockId,
					'cancellation',
					$item,
					$products,
					'order',
					$item->customerOrder->number
				);

			}
		}
	}

	/**
	 * Return available products quantity.
	 *
	 * @param $stockId
	 * @param $productId
	 *
	 * @return int
	 */
	protected function getAvailableProductsQuantity($stockId, $item)
	{
		$available = 0;

		/** @var Product $product */
		$product = $this->products->find($item->product->id);

		if ($product) {

			$numberInPack = (int)$product->number_in_package ?: 1;

			$availableCount = $this->stockProducts->countAvailableForItem($stockId, $item);

			$available = $availableCount - ($availableCount % $numberInPack);
		}

		return $available;
	}

	/**
	 * Create back order for the customer order item.
	 *
	 * @param $item
	 * @param $availableProducts
	 *
	 * @return mixed
	 */
	protected function createBackOrderForItem($stockId, $item, $availableProducts)
	{
		$quantity = $item->products_quantity - $availableProducts;

		if ($quantity) {

			$common = $this->getCommonItemAttributes($item, $quantity);

			$attributes = array_merge(
				$common,
				[
					'back_order' => true,
					'expected_date' => $this->getBackOrderExpectedDate($item->product->id),
					'status' => config('stock.status.open'),
					'customer_order_id' => $item->customerOrder->id,
					'product_id' => $item->product->id,
				]
			);

			return $this->customerOrderItems->create($attributes);
		}

		return null;
	}

	/**
	 * Update an order item.
	 *
	 * @param $item
	 * @param $backOrder
	 */
	protected function updateOrderItem($item, CustomerOrderItem $backOrder = null)
	{
		$quantity = $item->products_quantity;

		$common = [];

		if ($backOrder) {
			$quantity -= $backOrder->products_quantity;
			$common = $this->getCommonItemAttributes($item, $quantity);
		}

		$attributes = array_merge(
			$common,
			[
				'back_order' => $quantity > 0 ? false : true,
			]
		);

		if ($quantity) {

			$this->customerOrderItems->update($attributes, $item->id);

			return $this->customerOrderItems->with(['product', 'product.productGroup', 'customer', 'customerOrder'])->find($item->id);

		} else {
			$this->customerOrderItems->destroy($item->id);

			return null;
		}
	}

	/**
	 * Return common calculated attributes.
	 *
	 * @param $item
	 * @param $productsQuantity
	 *
	 * @return array
	 */
	protected function getCommonItemAttributes($item, $productsQuantity)
	{
		$product = $item->product;
		$salesUnitQuantity = $productsQuantity / $item->product->productGroup->sales_unit_volume;
		$totalPrice = $productsQuantity * $item->product_price;
		$totalDepositPrice = $productsQuantity * $product->deposit_price;
		$depositPrice = (float)$product->deposit_price;
		$depositVat = (int)$product->deposit_vat;

		return [
			'customer_id' => $item->customer_id,
			'customer_order_id' => $item->customer_order_id,

			'bypass' => $item->bypass,
			'back_order' => $item->backorder,
			'expected_date' => $item->expected_date,
			'cancelled' => $item->cancelled,

			'sales_unit_quantity' => $salesUnitQuantity,
			'packages_quantity' => $salesUnitQuantity * $item->product->productGroup->sales_unit_volume / $item->product->number_in_package,
			'products_quantity' => $productsQuantity,

			'product_name' => $item->product_name,
			'product_manual_price' => $item->product_manual_price,
			'product_price' => $item->product_price,
			'product_vat_price' => $item->product_price + ($item->product_price * ($item->product->productGroup->vat / 100)),

			'total_price' => $totalPrice,
			'total_vat_price' => $totalPrice + ($totalPrice * ($item->vat / 100)),
			'vat' => $item->vat,

			'deposit_enabled' => $product->deposit_enabled,

			'deposit_price' => $depositPrice,
			'deposit_vat' => $depositVat,
			'deposit_vat_price' => $depositPrice + ($depositPrice * ($depositVat / 100)),

			'deposit_total_price' => $totalDepositPrice,
			'deposit_total_vat' => 0.00,
			'deposit_total_vat_price' => $totalDepositPrice + ($totalDepositPrice * ($depositVat / 100)),
		];
	}

	/**
	 * Return back order's expected date by the product id.
	 *
	 * @param int $productId
	 *
	 * @return mixed
	 */
	protected function getBackOrderExpectedDate($productId)
	{
		return null;
	}

	/**
	 * @param $stockId
	 * @param string $type
	 *
	 * @return StockMovement
	 */
	protected function getCurrentStockMovement($stockId, $type = 'receipt')
	{
		$storage = camel_case(sprintf('current_stock_%s_movement', $type));

		if (!$this->{$storage}) {
			$this->{$storage} = $this->stockMovements->create(
				[
					'stock_id' => $stockId,
					'movement_type' => $type,
				]
			);
		}

		return $this->{$storage};
	}

	protected function registerStockMovementProductForItem(
		$stockId,
		$type,
		CustomerOrderItem $item,
		Collection $products,
		$movementType,
		$comment = ''
	)
	{
		/** @var StockMovement $movement */
		$movement = $this->getCurrentStockMovement($stockId, $type);

		/**
		 * @var string $delivery_number
		 * @var Collection $deliveryGroup
		 */
		foreach ($products->groupBy('delivery_number') as $delivery_number => $deliveryGroup) {

			/**
			 * @var string $expiration_date
			 * @var Collection $expirationGroup
			 */
			foreach ($deliveryGroup->groupBy('expiration_date') as $expiration_date => $expirationGroup) {

				$this->stockMovementProducts->create(
					[
						'stock_movement_id' => $movement->getKey(),
						'product_id' => $item->product_id,
						'product_name' => $item->product_name,
						'products_quantity' => $expirationGroup->count(),
						'delivery_number' => $delivery_number,
						'expiration_date' => $expiration_date,
						'movement_type' => $movementType,
						'comment' => $comment,
					]
				);

			}

		}
	}


	/**
	 * @return array
	 */
	protected function getParentResourceNames()
	{
		return [
			'customer_order_item',
		];
	}
}
