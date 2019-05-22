<?php

namespace App\Transformers\Dashboard;

use App\StockMovement;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * StockMovement transformer.
 *
 * @package App\Transformers\Dashboard
 */
class StockMovementTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'movement_type' => $request->get('movement_type'),
			'stock' => (integer)$request->get('stock'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'movement_type' => $request->get('movement_type'),
			'stock' => (integer)$request->get('stock'),

		];
	}

	/**
	 * @param StockMovement $stockMovement
	 * @return array
	 */
	public static function toArray($stockMovement)
	{
		return [
			'id' => (int)$stockMovement->getKey(),
			'movement_type' => $stockMovement->movement_type,
			'stock' => $stockMovement->stock ? StockTransformer::toArray($stockMovement->stock) : null,

			'created_at' => (string)$stockMovement->created_at,
			'updated_at' => (string)$stockMovement->updated_at,
			'deleted_at' => (string)$stockMovement->deleted_at,
		];
	}
}