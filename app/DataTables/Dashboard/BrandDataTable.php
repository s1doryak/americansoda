<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Brand;

/**
 * Brand datatable.
 *
 * @package App\DataTables\Dashboard
 */
class BrandDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'name',
				'logo',
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

        ];
    }

	/**
	 * @param Brand $brand
	 * @return array
	 */
	protected function getActions($brand)
	{
		return parent::getActions($brand);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
