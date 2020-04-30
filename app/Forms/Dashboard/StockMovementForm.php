<?php

namespace App\Forms\Dashboard;

use App\StockMovement;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * StockMovement form.
 *
 * @package App\Forms\Dashboard
 */
class StockMovementForm extends Form
{
    /**
     * @return array
     */
	public static function getCreateFormFields()
	{
		$mt_prefix = 'models/stock_movement.movement_types';

		return [
			'movement_type' => [
				'type' => 'select',
				'expanded' => true,
				'multiple' => false,
				'choices' => [
					'receipt' => trans(sprintf('%s.receipt', $mt_prefix)),
					'cancellation' => trans(sprintf('%s.cancellation', $mt_prefix)),
				],
				'selected' => 'receipt',
				'choice_options' => [
					'inline' => true,
				],
			],
			'stock' => 'select',
			'stockMovementProducts[0]' => [
				'type' => 'relation_form',
				'fields' => StockMovementProductForm::getCreateFormFields(),
				'form_title' => trans('models/stock_movement_product.labels.plural'),
				'resource' => 'stock_movement_product',
			],
		];
	}

    /**
     * @param StockMovement $stockMovement
     * @return array
     */
	public static function getEditFormFields($stockMovement)
	{
		$mt_prefix = 'models/stock_movement.movement_types';

		return [
			'movement_type' => [
				'type' => 'select',
				'expanded' => true,
				'multiple' => false,
				'choices' => [
					'receipt' => trans(sprintf('%s.receipt', $mt_prefix)),
					'cancellation' => trans(sprintf('%s.cancellation', $mt_prefix)),
				],
				'selected' => 'receipt',
				'choice_options' => [
					'inline' => true,
				],
			],
			'stock' => 'select',
			'stockMovementProducts[0]' => [
				'type' => 'relation_form',
				'fields' => StockMovementProductForm::getCreateFormFields(),
				'form_title' => trans('models/stock_movement_product.labels.plural'),
                'items' => $stockMovement->stockMovementProducts,
				'resource' => 'stock_movement_product',
			],
		];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'movement_type' => 'required|in:receipt,cancellation',
			'stock' => 'required|exists:stocks,id',
			'stockMovementProducts.*.product' => 'required|exists:products,id',
			'stockMovementProducts.*.products_quantity' => 'required|integer|min:1',
			'stockMovementProducts.*.movement_type' => 'required',
			'stockMovementProducts.*.expiration_date' => 'sometimes|required_if:movement_type,receipt',
        ];
	}

    /**
     * @param StockMovement $stockMovement
     * @return array
     */
	public static function getUpdateValidationRules($stockMovement)
	{
        return [
			'movement_type' => 'required|in:receipt,cancellation',
			'stock' => 'required|exists:stocks,id',
			'stockMovementProducts.*.product' => 'required|exists:products,id',
			'stockMovementProducts.*.products_quantity' => 'required|integer|min:1',
			'stockMovementProducts.*.movement_type' => 'required',
			'stockMovementProducts.*.expiration_date' => 'sometimes|required_if:movement_type,receipt',
        ];
	}
}