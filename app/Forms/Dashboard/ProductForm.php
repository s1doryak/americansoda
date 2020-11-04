<?php

namespace App\Forms\Dashboard;

use App\Product;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Product form.
 *
 * @package App\Forms\Dashboard
 */
class ProductForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        return [
            'name' => 'text',
            'product_barcode' => 'text',
            'product_barcode_plaintext' => 'text',
            'package_barcode' => 'text',
            'package_barcode_plaintext' => 'text',
            'product_image' => 'image',
            'package_image' => 'image',
            'description' => 'textarea',
            'contents' => 'textarea',
            'number_in_package' => 'number',
            'weight' => 'text',
            'volume' => 'text',
            'brutto_weight' => 'text',
            'brutto_volume' => 'text',
            'unit_type' => 'text',
            'deposit_enabled' => 'checkbox',
            'deposit_price' => 'text',
            'deposit_vat' => 'number',
            'deposit_vat_price' => 'text',
            'comment' => 'textarea',
            'brand' => 'choice',
            'packageType' => 'choice',
            'productGroup' => 'choice',
            'productTags' => [
                'type' => 'choice',
                'attr' => [
                    'multiple' => true,
                ],
            ],
            'discount_price_enable' => [
                'type' => 'checkbox',
                'attr' => [
                    'data-toggle' => 'collapse',
                    'data-target' => '#product-form .discount_price_enabled_fields',
                ],
            ],
			'discount_price' => 'text',
			'new' => 'checkbox',
			'action' => 'checkbox',
            'future_stock_movement_enable' => [
                'type' => 'checkbox',
                'attr' => [
                    'data-toggle' => 'collapse',
                    'data-target' => '#product-form .future_stock_movement_enabled_fields',
                ],
            ],
			'future_stock_movement' => 'datepicker',
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    public static function getEditFormFields($product)
    {
        return [
            'name' => 'text',
            'product_barcode' => 'text',
            'product_barcode_plaintext' => 'text',
            'package_barcode' => 'text',
            'package_barcode_plaintext' => 'text',
            'product_image' => 'image',
            'package_image' => 'image',
            'description' => 'textarea',
            'contents' => 'textarea',
            'number_in_package' => 'number',
            'weight' => 'text',
            'volume' => 'text',
            'brutto_weight' => 'text',
            'brutto_volume' => 'text',
            'unit_type' => 'text',
            'deposit_enabled' => 'checkbox',
            'deposit_price' => 'text',
            'deposit_vat' => 'number',
            'deposit_vat_price' => 'text',
            'comment' => 'textarea',
            'brand' => 'choice',
            'packageType' => 'choice',
            'productGroup' => 'choice',
            'productTags' => [
                'type' => 'select',
                'attr' => [
                    'multiple' => true,
                ],
            ],
            'discount_price_enable' => [
                'type' => 'checkbox',
                'value' => (bool)$product->discount_price,
                'attr' => [
                    'data-toggle' => 'collapse',
                    'data-target' => '#product-form .discount_price_enabled_fields',
                ],
            ],
            'discount_price' => 'text',
			'new' => 'checkbox',
			'action' => 'checkbox',
            'future_stock_movement_enable' => [
                'type' => 'checkbox',
                'value' => (bool)$product->future_stock_movement,
                'attr' => [
                    'data-toggle' => 'collapse',
                    'data-target' => '#product-form .future_stock_movement_enabled_fields',
                ],
            ],
            'future_stock_movement' => 'datepicker',
        ];
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return ['name' => 'sometimes',
            'product_barcode' => 'sometimes',
            'product_barcode_plaintext' => 'sometimes',
            'package_barcode' => 'sometimes',
            'package_barcode_plaintext' => 'sometimes',
            'product_image' => 'sometimes',
            'package_image' => 'sometimes',
            'description' => 'sometimes',
            'contents' => 'sometimes',
            'number_in_package' => 'sometimes',
            'weight' => 'sometimes',
            'volume' => 'sometimes',
            'brutto_weight' => 'sometimes',
            'brutto_volume' => 'sometimes',
            'unit_type' => 'sometimes',
            'deposit_enabled' => 'sometimes',
            'deposit_price' => 'sometimes',
            'deposit_vat' => 'sometimes',
            'deposit_vat_price' => 'sometimes',
            'comment' => 'sometimes',
            'brand' => 'sometimes|exists:brands,id',
            'packageType' => 'sometimes|exists:package_types,id',
            'productGroup' => 'sometimes|exists:product_groups,id',
            'productTags' => 'sometimes|exists:product_tags,id',
			'discount_price' => 'sometimes',
			'new' => 'sometimes',
			'action' => 'sometimes',
			'future_stock_movement' => 'sometimes',
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    public static function getUpdateValidationRules($product)
    {
        return [
            'name' => 'sometimes',
            'product_barcode' => 'sometimes',
            'product_barcode_plaintext' => 'sometimes',
            'package_barcode' => 'sometimes',
            'package_barcode_plaintext' => 'sometimes',
            'product_image' => 'sometimes',
            'package_image' => 'sometimes',
            'description' => 'sometimes',
            'contents' => 'sometimes',
            'number_in_package' => 'sometimes',
            'weight' => 'sometimes',
            'volume' => 'sometimes',
            'brutto_weight' => 'sometimes',
            'brutto_volume' => 'sometimes',
            'unit_type' => 'sometimes',
            'deposit_enabled' => 'sometimes',
            'deposit_price' => 'sometimes',
            'deposit_vat' => 'sometimes',
            'deposit_vat_price' => 'sometimes',
            'comment' => 'sometimes',
            'brand' => 'sometimes|exists:brands,id',
            'packageType' => 'sometimes|exists:package_types,id',
            'productTags' => 'sometimes|exists:product_tags,id',
			'discount_price' => 'sometimes',
			'new' => 'sometimes',
			'action' => 'sometimes',
			'future_stock_movement' => 'sometimes',
        ];
    }
}
