<?php

namespace App\Forms\Dashboard;

use App\CustomerShipment;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * CustomerShipment form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerShipmentForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
				'number' => 'text',
				'assembly_number' => 'text',
				'invoice_number' => 'text',
				'status' => 'text',
				'delivery_type' => 'text',
				'packages_quantity' => 'number',
				'comment' => 'editor',
				'packageType' => 'choice',
				'customer' => 'choice',
				'user' => 'choice',
        ];
	}

    /**
     * @param CustomerShipment $customerShipment
     * @return array
     */
	public static function getEditFormFields($customerShipment)
	{
        return [
				'number' => 'text',
				'assembly_number' => 'text',
				'invoice_number' => 'text',
				'status' => 'text',
				'delivery_type' => 'text',
				'packages_quantity' => 'number',
				'comment' => 'editor',
				'packageType' => 'choice',
				'customer' => 'choice',
				'user' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'number' => 'sometimes',
			'assembly_number' => 'sometimes',
			'invoice_number' => 'sometimes',
			'status' => 'sometimes',
			'delivery_type' => 'sometimes',
			'packages_quantity' => 'sometimes',
			'comment' => 'sometimes',
			'packageType' => 'sometimes|exists:package_types,id',
			'customer' => 'sometimes|exists:customers,id',
			'user' => 'sometimes|exists:users,id',
        ];
	}

    /**
     * @param CustomerShipment $customerShipment
     * @return array
     */
	public static function getUpdateValidationRules($customerShipment)
	{
        return [
			'number' => 'sometimes',
			'assembly_number' => 'sometimes',
			'invoice_number' => 'sometimes',
			'status' => 'sometimes',
			'delivery_type' => 'sometimes',
			'packages_quantity' => 'sometimes',
			'comment' => 'sometimes',
			'packageType' => 'sometimes|exists:package_types,id',
			'customer' => 'sometimes|exists:customers,id',
			'user' => 'sometimes|exists:users,id',
        ];
	}
}