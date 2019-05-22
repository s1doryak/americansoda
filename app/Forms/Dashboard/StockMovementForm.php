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
        return [
				'movement_type' => 'text',
				'stock' => 'choice',
        ];
	}

    /**
     * @param StockMovement $stockMovement
     * @return array
     */
	public static function getEditFormFields($stockMovement)
	{
        return [
				'movement_type' => 'text',
				'stock' => 'choice',
        ];
	}

    /**
     * @return array
     */
	public static function getStoreValidationRules()
	{
        return [
			'movement_type' => 'sometimes',
			'stock' => 'sometimes|exists:stocks,id',
        ];
	}

    /**
     * @param StockMovement $stockMovement
     * @return array
     */
	public static function getUpdateValidationRules($stockMovement)
	{
        return [
			'movement_type' => 'sometimes',
			'stock' => 'sometimes|exists:stocks,id',
        ];
	}
}