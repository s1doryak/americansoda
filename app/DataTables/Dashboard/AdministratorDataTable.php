<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Administrator;

/**
 * Administrator datatable.
 *
 * @package App\DataTables\Dashboard
 */
class AdministratorDataTable extends DataTable
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
	 * @param Administrator $administrator
	 * @return array
	 */
	protected function getActions($administrator)
	{
		return parent::getActions($administrator);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
