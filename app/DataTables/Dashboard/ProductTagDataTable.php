<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\ProductTag;

/**
 * ProductTag datatable.
 *
 * @package App\DataTables\Dashboard
 */
class ProductTagDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'name',
				'icon',
				'color',
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
				'products.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'products.id',
					'lists' => 'products.name',
				],
        ];
    }

	/**
	 * @param ProductTag $productTag
	 * @return array
	 */
	protected function getActions($productTag)
	{
		return parent::getActions($productTag);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
