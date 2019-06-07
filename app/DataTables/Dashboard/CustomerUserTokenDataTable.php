<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerUserToken;

/**
 * CustomerUserToken datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerUserTokenDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'token',
			'ip_address',
			'user_agent',
			'customerUser.name' => [
				'data' => 'customerUser.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'token',
			'ip_address',
			'user_agent',
			'customerUser.name',
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
			'customerUser.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customerUser.id',
				'lists' => 'customerUser.name',
			],
        ];
    }

	/**
	 * @param CustomerUserToken $customerUserToken
	 * @return array
	 */
	protected function getActions($customerUserToken)
	{
		return parent::getActions($customerUserToken);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
