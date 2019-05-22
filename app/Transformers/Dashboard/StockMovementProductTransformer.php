<?php

namespace App\Transformers\Dashboard;

use App\StockMovementProduct;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * StockMovementProduct transformer.
 *
 * @package App\Transformers\Dashboard
 */
class StockMovementProductTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'product_name' => $request->get('product_name'),
			'products_quantity' => (integer)$request->get('products_quantity'),
			'delivery_number' => $request->get('delivery_number'),
			'expiration_date' => $request->get('expiration_date'),
			'movement_type' => $request->get('movement_type'),
			'comment' => $request->get('comment'),
			'stockMovement' => (integer)$request->get('stockMovement'),
			'product' => (integer)$request->get('product'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'product_name' => $request->get('product_name'),
			'products_quantity' => (integer)$request->get('products_quantity'),
			'delivery_number' => $request->get('delivery_number'),
			'expiration_date' => $request->get('expiration_date'),
			'movement_type' => $request->get('movement_type'),
			'comment' => $request->get('comment'),
			'stockMovement' => (integer)$request->get('stockMovement'),
			'product' => (integer)$request->get('product'),

		];
	}

	/**
	 * @param StockMovementProduct $stockMovementProduct
	 * @return array
	 */
	public static function toArray($stockMovementProduct)
	{
		return [
			'id' => (int)$stockMovementProduct->getKey(),
			'product_name' => $stockMovementProduct->product_name,
			'products_quantity' => (integer)$stockMovementProduct->products_quantity,
			'delivery_number' => $stockMovementProduct->delivery_number,
			'expiration_date' => $stockMovementProduct->expiration_date,
			'movement_type' => $stockMovementProduct->movement_type,
			'comment' => $stockMovementProduct->comment,
			'stockMovement' => $stockMovementProduct->stockMovement ? StockMovementTransformer::toArray($stockMovementProduct->stockMovement) : null,
			'product' => $stockMovementProduct->product ? ProductTransformer::toArray($stockMovementProduct->product) : null,

			'created_at' => (string)$stockMovementProduct->created_at,
			'updated_at' => (string)$stockMovementProduct->updated_at,
			'deleted_at' => (string)$stockMovementProduct->deleted_at,
		];
	}
}