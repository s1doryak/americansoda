<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\PackageType;

/**
 * PackageType datatable.
 *
 * @package App\DataTables\Dashboard
 */
class PackageTypeDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
            'name' => [
                'searchable' => true
            ],
            'created_at',
            'updated_at',
		];
	}

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'name',
            'action',
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
	 * @param PackageType $packageType
	 * @return array
	 */
	protected function getActions($packageType)
	{
		return parent::getActions($packageType);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
