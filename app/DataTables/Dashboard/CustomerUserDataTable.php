<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerUser;

/**
 * CustomerUser datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerUserDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'email',
			'name',
			'phone',
			'comment',
			'customers.name' => [
				'data' => 'customers.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'email',
			'name',
			'phone',
			'comment',
			'customers.name',
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
			'customers.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customers.id',
				'lists' => 'customers.name',
			],
        ];
    }

	/**
	 * @param CustomerUser $customerUser
	 * @return array
	 */
	protected function getActions($customerUser)
	{
		return parent::getActions($customerUser);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
