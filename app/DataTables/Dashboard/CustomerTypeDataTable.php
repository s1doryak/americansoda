<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerType;

/**
 * CustomerType datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerTypeDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'name',
				'customerType.name' => [
					'data' => 'customerType.name'
				],
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
				'customerType.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customerType.id',
					'lists' => 'customerType.name',
				],
        ];
    }

	/**
	 * @param CustomerType $customerType
	 * @return array
	 */
	protected function getActions($customerType)
	{
		return parent::getActions($customerType);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
