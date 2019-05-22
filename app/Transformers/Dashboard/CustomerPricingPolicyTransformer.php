<?php

namespace App\Transformers\Dashboard;

use App\CustomerPricingPolicy;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerPricingPolicy transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerPricingPolicyTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'products_range' => (integer)$request->get('products_range'),
			'price' => $request->get('price'),
			'productGroup' => (integer)$request->get('productGroup'),
			'customer' => (integer)$request->get('customer'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'products_range' => (integer)$request->get('products_range'),
			'price' => $request->get('price'),
			'productGroup' => (integer)$request->get('productGroup'),
			'customer' => (integer)$request->get('customer'),

		];
	}

	/**
	 * @param CustomerPricingPolicy $customerPricingPolicy
	 * @return array
	 */
	public static function toArray($customerPricingPolicy)
	{
		return [
			'id' => (int)$customerPricingPolicy->getKey(),
			'products_range' => (integer)$customerPricingPolicy->products_range,
			'price' => $customerPricingPolicy->price,
			'productGroup' => $customerPricingPolicy->productGroup ? ProductGroupTransformer::toArray($customerPricingPolicy->productGroup) : null,
			'customer' => $customerPricingPolicy->customer ? CustomerTransformer::toArray($customerPricingPolicy->customer) : null,

			'created_at' => (string)$customerPricingPolicy->created_at,
			'updated_at' => (string)$customerPricingPolicy->updated_at,
			'deleted_at' => (string)$customerPricingPolicy->deleted_at,
		];
	}
}