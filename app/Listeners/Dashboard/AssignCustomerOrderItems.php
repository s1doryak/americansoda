<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\CustomerOrderItemsAssigned;
use Crmplease\MaterialAdmin\Events\ResourceDestroyed;
use Crmplease\MaterialAdmin\Events\ResourceRestored;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceTrashed;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerPricingPolicyRepository;
use App\Repositories\Contracts\ProductRepository;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class AssignCustomerOrderItems
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var CustomerOrderRepository
     */
    protected $customerOrders;

    /**
     * @var CustomerOrderItemRepository
     */
    protected $customerOrderItems;

    /**
     * @var CustomerPricingPolicyRepository
     */
    protected $customerPricingPolicies;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * AssignCustomerOrderItems constructor.
     * @param CustomerOrderRepository $customerOrderRepository
     * @param CustomerOrderItemRepository $customerOrderItemRepository
     * @param CustomerPricingPolicyRepository $customerPricingPolicyRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        CustomerOrderRepository $customerOrderRepository,
        CustomerOrderItemRepository $customerOrderItemRepository,
        CustomerPricingPolicyRepository $customerPricingPolicyRepository,
        ProductRepository $productRepository
    )
    {
        $this->customerOrders = $customerOrderRepository;
        $this->customerOrderItems = $customerOrderItemRepository;
        $this->customerPricingPolicies = $customerPricingPolicyRepository;
        $this->products = $productRepository;
    }

    /**
     * Handle the event.
     *
     * @param ResourceEventInterface $event
     *
     * @return void
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function handle(ResourceEventInterface $event)
    {

        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        $attributes = $event->getAttributes();
        $params = $event->getParams();

        $order = $this->customerOrders->scopeQuery(
            function ($query) {
                /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                return $query->withTrashed();
            }
        )->find($attributes['id']);

        if ($event instanceof ResourceTrashed) {

            $customerOrderItems = $this->customerOrderItems->with(
                ['product', 'product.productGroup', 'customer', 'customerOrder']
            )->findAllByOrderId($attributes['id']);

            $this->customerOrderItems->trashWhere(
                [
                    ['customer_order_id', 'in', $customerOrderItems->pluck('customer_order_id')]
                ]
            );
        }

        if ($event instanceof ResourceDestroyed) {

            $customerOrderItems = $this->customerOrderItems->with(
                ['product', 'product.productGroup', 'customer', 'customerOrder']
            )->findAllByOrderId($attributes['id']);

            $this->customerOrderItems->destroyWhere(
                [
                    ['customer_order_id', 'in', $customerOrderItems->pluck('customer_order_id')]
                ]
            );
        }

        if ($event instanceof ResourceRestored) {

            $customerOrderItems = $this->customerOrderItems->with(
                ['product', 'product.productGroup', 'customer', 'customerOrder']
            )->findAllByOrderId($attributes['id']);

            $this->customerOrderItems->restoreWhere(
                [
                    ['customer_order_id', 'in', $customerOrderItems->pluck('customer_order_id')]
                ]
            );
        }

        $items = Arr::get($params, 'customerOrderItems', []);

        $totalQuantity = $this->getTotalSalesUnitQuantity($items);

        foreach ($items as $idx => $item) {

            $id = $item['id'] ?? false;
            $status = $item['status'] ?? false;
            $removing = $item['_remove'] ?? false;

            if ($removing) {

                if ($id) {
                    $this->customerOrderItems->destroy($item['id']);
                }

                continue;
            }

            if ($status && $status === config('stock.status.invoice')) {
                continue;
            }

            $item['product_manual_price'] = booleanize($item['product_manual_price'] ?? false);

            $product = $this->products->with('productGroup')->find($item['product']);
            $productGroup = $product->productGroup;
            $price = $item['product_manual_price'] ? $item['product_price'] : $this->customerPricingPolicies->getPriceBySalesUnitQuantity(
                $totalQuantity,
                $attributes['customer_id'],
                $productGroup->id
            );

            $depositPrice = (float)$product->deposit_price;
            $depositVat = (int)$product->deposit_vat;

            unset($item['product']);

            $item['product_id'] = $product->id;
            $item['product_name'] = $product->name;
            $item['product_price'] = $price;
            $item['product_vat_price'] = $price + ($price * ($productGroup->vat / 100));
            $item['packages_quantity'] = $item['sales_unit_quantity'] * $productGroup->sales_unit_volume / $product->number_in_package;

            $item['products_quantity'] = $item['packages_quantity'] * $product->number_in_package;

            $item['total_price'] = $item['products_quantity'] * $item['product_price'];
            $item['total_vat_price'] = $item['total_price'] + ($item['total_price'] * ($productGroup->vat / 100));
            $item['vat'] = $productGroup->vat;

            $item['bypass'] = (isset($item['bypass']) ? (boolean)$item['bypass'] : false);
            $item['back_order'] = (isset($item['back_order']) ? (boolean)$item['back_order'] : false);

            if ($event instanceof ResourceStored) {
                $item['status'] = config('stock.status.open');
            }

            if ($item['back_order']) {
                if (isset($item['expected_date']) && $item['expected_date']) {
                    $item['expected_date'] = Carbon::createFromFormat('d/m/Y', $item['expected_date']);
                } else {
                    $item['expected_date'] = Carbon::now()->addDays(7);
                }

                $item['status'] = config('stock.status.open');
                $item['customer_shipment_id'] = null;
            } else {
                $item['expected_date'] = null;
            }

            $item['cancelled'] = (isset($item['cancelled']) ? (boolean)$item['cancelled'] : false);

            $item['deposit_enabled'] = $product->deposit_enabled;

            $item['deposit_price'] = $depositPrice;
            $item['deposit_vat'] = $depositVat;
            $item['deposit_vat_price'] = $depositPrice + ($depositPrice * ($depositVat / 100));

            $item['deposit_total_price'] = $item['products_quantity'] * $item['deposit_price'];
            $item['deposit_total_vat'] = 0.00;
            $item['deposit_total_vat_price'] = $item['products_quantity'] * $item['deposit_vat_price'];

            $item['customer_id'] = $attributes['customer_id'];
            $item['customer_order_id'] = $attributes['id'];

            if ($event instanceof ResourceStored) {
                $this->customerOrderItems->create($item);
            } else {
                $id = Arr::pull($item, 'id');
                $this->customerOrderItems->updateOrCreate(compact('id'), $item);
            }
        }

        $customerOrderItems = $this->customerOrderItems->with(
            ['product', 'product.productGroup', 'customer', 'customerOrder']
        )->findAllByOrderId($attributes['id']);

        event(new CustomerOrderItemsAssigned($order, $customerOrderItems, $attributes, $params));
    }

    /**
     * @return array
     */
    protected function getValidNamespaces()
    {
        return [
            'dashboard',
        ];
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'customer.order',
            'customer_order',
        ];
    }

    /**
     * @param Collection $items
     *
     * @return mixed
     */
    protected function getTotalSalesUnitQuantity($items)
    {
        return collect($items)->filter(function ($item) {
            return false === booleanize($item['_remove'] ?? false);
        })->sum('sales_unit_quantity');
    }
}
