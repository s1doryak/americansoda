<?php

namespace App\Transformers\Dashboard;

use App\ProductGroup;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * ProductGroup transformer.
 *
 * @package App\Transformers\Dashboard
 */
class ProductGroupTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'name' => $request->get('name'),
			'vat' => (integer)$request->get('vat'),
			'sales_unit_volume' => (integer)$request->get('sales_unit_volume'),
			'productType' => (integer)$request->get('productType'),


		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'name' => $request->get('name'),
			'vat' => (integer)$request->get('vat'),
			'sales_unit_volume' => (integer)$request->get('sales_unit_volume'),
			'productType' => (integer)$request->get('productType'),


		];
	}

	/**
	 * @param ProductGroup $productGroup
	 * @return array
	 */
	public static function toArray($productGroup)
	{
		return [
			'id' => (int)$productGroup->getKey(),
			'name' => $productGroup->name,
			'vat' => (integer)$productGroup->vat,
			'sales_unit_volume' => (integer)$productGroup->sales_unit_volume,


			'created_at' => (string)$productGroup->created_at,
			'updated_at' => (string)$productGroup->updated_at,
			'deleted_at' => (string)$productGroup->deleted_at,
			'productType' => $productGroup->productType ? ProductTypeTransformer::toArray($productGroup->productType) : null,
		];
	}
}