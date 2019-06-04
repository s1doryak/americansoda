<?php

namespace App\Forms\Dashboard;

use App\PriceGroupBreakpoint;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * PriceGroupBreakpoint form.
 *
 * @package App\Forms\Dashboard
 */
class PriceGroupBreakpointForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
        return [
			'breakpoint' => 'text',
			'priceGroup' => 'choice',
			'productGroups' => 'choice',
        ];
	}

    /**
     * @param PriceGroupBreakpoint $priceGroupBreakpoint
     * @return array
     */
	public static function getEditFormFields($priceGroupBreakpoint)
	{
        return [
			'breakpoint' => 'text',
			'priceGroup' => 'choice',
			'productGroups' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'breakpoint' => 'sometimes',
			'priceGroup' => 'sometimes|exists:price_groups,id',
			'productGroups' => 'sometimes|exists:product_groups,id',
        ];
	}

    /**
     * @param PriceGroupBreakpoint $priceGroupBreakpoint
     * @return array
     */
	public static function getUpdateValidationRules($priceGroupBreakpoint)
	{
        return [
			'breakpoint' => 'sometimes',
			'priceGroup' => 'sometimes|exists:price_groups,id',
			'productGroups' => 'sometimes|exists:product_groups,id',
        ];
	}
}