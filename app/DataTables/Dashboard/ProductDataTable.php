<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Product;

/**
 * Product datatable.
 *
 * @package App\DataTables\Dashboard
 */
class ProductDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'name',
				'product_barcode',
				'product_barcode_plaintext',
				'package_barcode',
				'package_barcode_plaintext',
				'product_image',
				'package_image',
				'description',
				'contents',
				'number_in_package',
				'weight',
				'volume',
				'brutto_weight',
				'brutto_volume',
				'deposit_enabled',
				'deposit_price',
				'deposit_vat',
				'deposit_vat_price',
				'comment',
				'brand.name' => [
					'data' => 'brand.name'
				],
				'packageType.name' => [
					'data' => 'packageType.name'
				],
				'productGroup.name' => [
					'data' => 'productGroup.name'
				],
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
				'number_in_package',
				'weight',
				'volume',
				'brutto_weight',
				'brutto_volume',
				'deposit_price',
				'deposit_vat',
				'deposit_vat_price',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
				'brand.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'brand.id',
					'lists' => 'brand.name',
				],
				'packageType.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'packageType.id',
					'lists' => 'packageType.name',
				],
				'productGroup.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'productGroup.id',
					'lists' => 'productGroup.name',
				],
        ];
    }

	/**
	 * @param Product $product
	 * @return array
	 */
	protected function getActions($product)
	{
		return parent::getActions($product);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
