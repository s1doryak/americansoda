<?php

namespace App\Listeners\Dashboard;

use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\StockMovementProductRepository;
use App\Repositories\Contracts\StockProductRepository;
use App\StockProduct;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Collection;

class AssignStockMovementProducts
{
    use ValidatesResource, ValidatesNamespace;

	/**
	 * @var StockMovementProductRepository
	 */
	protected $stockMovementProducts;

	/**
	 * @var ProductRepository
	 */
	protected $products;

	/**
	 * @var StockProductRepository
	 */
	protected $stockProducts;

	/**
	 * @var array
	 */
	protected $spToCreate = [];

	public function __construct(
		StockMovementProductRepository $stockMovementProducts,
		ProductRepository $products,
		StockProductRepository $stockProducts
	)
	{
		$this->stockMovementProducts = $stockMovementProducts;
		$this->products = $products;
		$this->stockProducts = $stockProducts;
	}

	/**
	 * Handle the event.
	 *
	 * @param ResourceEventInterface $event
	 */
	public function handle(ResourceEventInterface $event)
	{
		if ($event->getResource() !== 'stock_movement') {
			return;
		}

		$attributes = $event->getAttributes();
		$params = $event->getParams();

		$items = array_get($params, 'stockMovementProducts');

		if (!is_array($items) || !count($items)) {
			return;
		}

		$movement_type = array_get($params, 'movement_type', 'receipt');

		/**
		 * Если приход, то добавим товары на склад.
		 */
		if ($movement_type == 'receipt') {

			$now = Carbon::now();

			foreach ($items as $item) {

				$stockMovementProduct = [];

				$stockMovementProduct['stock_movement_id'] = $attributes['id'];
				$stockMovementProduct['product_id'] = $item['product'];
				$stockMovementProduct['product_name'] = $this->products->find($item['product'])->name;
				$stockMovementProduct['products_quantity'] = $item['products_quantity'];
				$stockMovementProduct['delivery_number'] = $item['delivery_number'];
				$stockMovementProduct['expiration_date'] = $item['expiration_date'];
				$stockMovementProduct['movement_type'] = $item['movement_type'];
				$stockMovementProduct['comment'] = $item['comment'];

				$this->stockMovementProducts->create($stockMovementProduct);

				foreach (range(1, $item['products_quantity']) as $index) {
					$this->spToCreate[] = [
						'stock_id' => $params['stock'],
						'product_id' => $item['product'],
						'delivery_number' => $item['delivery_number'],
						'expiration_date' => $item['expiration_date'] ? Carbon::createFromFormat('d/m/Y', $item['expiration_date']) : null,
						'created_at' => $now,
						'updated_at' => $now
					];
				}
			}

			if (count($this->spToCreate)) {
				$this->stockProducts->bulkCreate($this->spToCreate);
			}

		} else {

			foreach ($items as $item) {

				$condition = [
				    ['customer_order_item_id', '=', null],
                    ['stock_id', '=', $params['stock']],
                    ['product_id', '=', $item['product']],
				];

				if (isset($item['delivery_number'])) {
                    $condition[] = ['delivery_number', '=', $item['delivery_number']];
				}

				$limit = $item['products_quantity'];

				/** @var Collection|StockProduct[] $stockProducts */
				$stockProducts = $this->stockProducts->findWhereLimit($condition, $limit);

				if ($stockProducts->count()) {

					$stockMovementProduct = [];

					$stockMovementProduct['stock_movement_id'] = $attributes['id'];
					$stockMovementProduct['product_id'] = $item['product'];
					$stockMovementProduct['product_name'] = $this->products->find($item['product'])->name;
					$stockMovementProduct['products_quantity'] = $stockProducts->count();
					$stockMovementProduct['delivery_number'] = $stockProducts->pluck('delivery_number')->unique()->filter()->implode(', ');
					$stockMovementProduct['expiration_date'] = $stockProducts->pluck('expiration_date')->unique()->filter()->implode(', ');
					$stockMovementProduct['movement_type'] = $item['movement_type'];
					$stockMovementProduct['comment'] = $item['comment'];

					$this->stockMovementProducts->create($stockMovementProduct);

					$this->stockProducts->destroyWhere([
						['id', 'in', $stockProducts->pluck('id')]
					]);
				}
			}

		}
	}

	/**
	 * @return array
	 */
	protected function getValidResources()
	{
		return [
			'stock_movement',
		];
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
}
