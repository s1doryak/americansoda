<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Company;

/**
 * Company datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CompanyDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'name',
				'legal_name',
				'short_name',
				'postcode',
				'address',
				'bid',
				'email',
				'phone',
				'code',
				'smtp_host',
				'smtp_port',
				'smtp_encryption',
				'smtp_username',
				'smtp_password',
				'smtp_from',
				'smtp_from_name',
				'region.name' => [
					'data' => 'region.name'
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
				'region.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'region.id',
					'lists' => 'region.name',
				],
        ];
    }

	/**
	 * @param Company $company
	 * @return array
	 */
	protected function getActions($company)
	{
		return parent::getActions($company);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
