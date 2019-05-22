<?php

namespace App\Transformers\Dashboard;

use App\CustomerPricingPolicyRevision;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerPricingPolicyRevision transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerPricingPolicyRevisionTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'revision_type' => $request->get('revision_type'),
			'revision_number' => (integer)$request->get('revision_number'),
			'products_range' => (integer)$request->get('products_range'),
			'price' => $request->get('price'),
			'revision' => (integer)$request->get('revision'),
			'customerPricingPolicy' => (integer)$request->get('customerPricingPolicy'),
			'editor' => (integer)$request->get('editor'),
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
			'revision_type' => $request->get('revision_type'),
			'revision_number' => (integer)$request->get('revision_number'),
			'products_range' => (integer)$request->get('products_range'),
			'price' => $request->get('price'),
			'revision' => (integer)$request->get('revision'),
			'customerPricingPolicy' => (integer)$request->get('customerPricingPolicy'),
			'editor' => (integer)$request->get('editor'),
			'productGroup' => (integer)$request->get('productGroup'),
			'customer' => (integer)$request->get('customer'),

		];
	}

	/**
	 * @param CustomerPricingPolicyRevision $customerPricingPolicyRevision
	 * @return array
	 */
	public static function toArray($customerPricingPolicyRevision)
	{
		return [
			'id' => (int)$customerPricingPolicyRevision->getKey(),
			'revision_type' => $customerPricingPolicyRevision->revision_type,
			'revision_number' => (integer)$customerPricingPolicyRevision->revision_number,
			'products_range' => (integer)$customerPricingPolicyRevision->products_range,
			'price' => $customerPricingPolicyRevision->price,
			'revision' => $customerPricingPolicyRevision->revision ? CustomerPricingPolicyRevisionTransformer::toArray($customerPricingPolicyRevision->revision) : null,
			'customerPricingPolicy' => $customerPricingPolicyRevision->customerPricingPolicy ? CustomerPricingPolicyTransformer::toArray($customerPricingPolicyRevision->customerPricingPolicy) : null,
			'editor' => $customerPricingPolicyRevision->editor ? UserTransformer::toArray($customerPricingPolicyRevision->editor) : null,
			'productGroup' => $customerPricingPolicyRevision->productGroup ? ProductGroupTransformer::toArray($customerPricingPolicyRevision->productGroup) : null,
			'customer' => $customerPricingPolicyRevision->customer ? CustomerTransformer::toArray($customerPricingPolicyRevision->customer) : null,

			'created_at' => (string)$customerPricingPolicyRevision->created_at,
			'updated_at' => (string)$customerPricingPolicyRevision->updated_at,
			'deleted_at' => (string)$customerPricingPolicyRevision->deleted_at,
		];
	}
}