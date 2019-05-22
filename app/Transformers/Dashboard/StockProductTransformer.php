<?php

namespace App\Transformers\Dashboard;

use App\StockProduct;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * StockProduct transformer.
 *
 * @package App\Transformers\Dashboard
 */
class StockProductTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'delivery_number' => $request->get('delivery_number'),
			'expiration_date' => $request->get('expiration_date'),
			'stock' => (integer)$request->get('stock'),
			'product' => (integer)$request->get('product'),
			'customerOrderItem' => (integer)$request->get('customerOrderItem'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'delivery_number' => $request->get('delivery_number'),
			'expiration_date' => $request->get('expiration_date'),
			'stock' => (integer)$request->get('stock'),
			'product' => (integer)$request->get('product'),
			'customerOrderItem' => (integer)$request->get('customerOrderItem'),

		];
	}

	/**
	 * @param StockProduct $stockProduct
	 * @return array
	 */
	public static function toArray($stockProduct)
	{
		return [
			'id' => (int)$stockProduct->getKey(),
			'delivery_number' => $stockProduct->delivery_number,
			'expiration_date' => $stockProduct->expiration_date,
			'stock' => $stockProduct->stock ? StockTransformer::toArray($stockProduct->stock) : null,
			'product' => $stockProduct->product ? ProductTransformer::toArray($stockProduct->product) : null,
			'customerOrderItem' => $stockProduct->customerOrderItem ? CustomerOrderItemTransformer::toArray($stockProduct->customerOrderItem) : null,

			'created_at' => (string)$stockProduct->created_at,
			'updated_at' => (string)$stockProduct->updated_at,
			'deleted_at' => (string)$stockProduct->deleted_at,
		];
	}
}