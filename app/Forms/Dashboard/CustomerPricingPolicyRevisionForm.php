<?php

namespace App\Forms\Dashboard;

use App\CustomerPricingPolicyRevision;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerPricingPolicyRevision form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerPricingPolicyRevisionForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'revision_type' => 'text',
				'revision_number' => 'number',
				'products_range' => 'number',
				'price' => 'text',
				'revision' => 'choice',
				'customerPricingPolicy' => 'choice',
				'editor' => 'choice',
				'productGroup' => 'choice',
				'customer' => 'choice',
        ];
	}

    /**
     * @param CustomerPricingPolicyRevision $customerPricingPolicyRevision
     * @return array
     */
	public static function getEditFormFields($customerPricingPolicyRevision)
	{
        return [
				'revision_type' => 'text',
				'revision_number' => 'number',
				'products_range' => 'number',
				'price' => 'text',
				'revision' => 'choice',
				'customerPricingPolicy' => 'choice',
				'editor' => 'choice',
				'productGroup' => 'choice',
				'customer' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'revision_type' => 'sometimes',
			'revision_number' => 'sometimes',
			'products_range' => 'sometimes',
			'price' => 'sometimes',
			'revision' => 'sometimes|exists:customer_pricing_policy_revisions,id',
			'customerPricingPolicy' => 'sometimes|exists:customer_pricing_policies,id',
			'editor' => 'sometimes|exists:users,id',
			'productGroup' => 'sometimes|exists:product_groups,id',
			'customer' => 'sometimes|exists:customers,id',
        ];
	}

    /**
     * @param CustomerPricingPolicyRevision $customerPricingPolicyRevision
     * @return array
     */
	public static function getUpdateValidationRules($customerPricingPolicyRevision)
	{
        return [
			'revision_type' => 'sometimes',
			'revision_number' => 'sometimes',
			'products_range' => 'sometimes',
			'price' => 'sometimes',
			'revision' => 'sometimes|exists:customer_pricing_policy_revisions,id',
			'customerPricingPolicy' => 'sometimes|exists:customer_pricing_policies,id',
			'editor' => 'sometimes|exists:users,id',
			'productGroup' => 'sometimes|exists:product_groups,id',
			'customer' => 'sometimes|exists:customers,id',
        ];
	}
}