<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\User;

/**
 * User datatable.
 *
 * @package App\DataTables\Dashboard
 */
class UserDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'email',
				'email',
				'name',
				'phone',
				'avatar',
				'role.name' => [
					'data' => 'role.name'
				],
				'company.name' => [
					'data' => 'company.name'
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
				'role.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'role.id',
					'lists' => 'role.name',
				],
				'company.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'company.id',
					'lists' => 'company.name',
				],
        ];
    }

	/**
	 * @param User $user
	 * @return array
	 */
	protected function getActions($user)
	{
		return parent::getActions($user);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
