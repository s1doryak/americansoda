<?php

namespace App\Forms\Dashboard;

use App\PriceGroupBreakpoint;
use App\Repositories\Contracts\ProductGroupRepository;
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
            '_remove' => 'hidden',
            'id' => 'hidden',
            'breakpoint' => 'text',
            'productGroups' => [
                'type' => 'choice',
                'groups' => app(ProductGroupRepository::class)->all(),
                'template' => 'dashboard::resources.price_group_breakpoint.fields.productGroups',
            ],
        ];
    }

    /**
     * @param PriceGroupBreakpoint $priceGroupBreakpoint
     * @return array
     */
    public static function getEditFormFields($priceGroupBreakpoint)
    {
        return [
            'id' => 'hidden',
            'breakpoint' => 'text',
            'priceGroup' => 'choice',
            'productGroups' => [
                'type' => 'choice',
                'groups' => app(ProductGroupRepository::class)->all(),
                'template' => 'dashboard::resources.price_group_breakpoint.fields.productGroups',
            ],
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
