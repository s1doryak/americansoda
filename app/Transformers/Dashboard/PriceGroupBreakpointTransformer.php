<?php

namespace App\Transformers\Dashboard;

use App\PriceGroupBreakpoint;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * PriceGroupBreakpoint transformer.
 *
 * @package App\Transformers\Dashboard
 */
class PriceGroupBreakpointTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'breakpoint' => $request->get('breakpoint'),
			'priceGroup' => (integer)$request->get('priceGroup'),
			'productGroups' => (array)$request->get('productGroups'),
		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'breakpoint' => $request->get('breakpoint'),
			'priceGroup' => (integer)$request->get('priceGroup'),
			'productGroups' => (array)$request->get('productGroups'),
		];
	}

	/**
	 * @param PriceGroupBreakpoint $priceGroupBreakpoint
	 * @return array
	 */
	public static function toArray($priceGroupBreakpoint)
	{
		return [
			'id' => (int)$priceGroupBreakpoint->getKey(),
			'breakpoint' => $priceGroupBreakpoint->breakpoint,
			'priceGroup' => $priceGroupBreakpoint->priceGroup ? PriceGroupTransformer::toArray($priceGroupBreakpoint->priceGroup) : null,
			'productGroups' => $priceGroupBreakpoint->productGroups ? ProductGroupTransformer::map($priceGroupBreakpoint->productGroups) : [],
			'created_at' => (string)$priceGroupBreakpoint->created_at,
			'updated_at' => (string)$priceGroupBreakpoint->updated_at,
			'deleted_at' => (string)$priceGroupBreakpoint->deleted_at,
		];
	}
}