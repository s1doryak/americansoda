<?php

namespace App\Forms\Dashboard;

use App\CustomerPricingPolicy;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerPricingPolicy form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerPricingPolicyForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'products_range' => 'number',
				'price' => 'text',
				'productGroup' => 'choice',
				'customer' => 'choice',
        ];
	}

    /**
     * @param CustomerPricingPolicy $customerPricingPolicy
     * @return array
     */
	public static function getEditFormFields($customerPricingPolicy)
	{
        return [
				'products_range' => 'number',
				'price' => 'text',
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
			'products_range' => 'sometimes',
			'price' => 'sometimes',
			'productGroup' => 'sometimes|exists:product_groups,id',
			'customer' => 'sometimes|exists:customers,id',
        ];
	}

    /**
     * @param CustomerPricingPolicy $customerPricingPolicy
     * @return array
     */
	public static function getUpdateValidationRules($customerPricingPolicy)
	{
        return [
			'products_range' => 'sometimes',
			'price' => 'sometimes',
			'productGroup' => 'sometimes|exists:product_groups,id',
			'customer' => 'sometimes|exists:customers,id',
        ];
	}
}