<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Assembly;

/**
 * Assembly datatable.
 *
 * @package App\DataTables\Dashboard
 */
class AssemblyDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'number',
				'comment',
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
	 * @param Assembly $assembly
	 * @return array
	 */
	protected function getActions($assembly)
	{
		return parent::getActions($assembly);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
