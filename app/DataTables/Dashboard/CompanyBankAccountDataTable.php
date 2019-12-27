<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CompanyBankAccount;

/**
 * CompanyBankAccount datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CompanyBankAccountDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'bank',
			'swift',
			'account',
			'iban',
			'default',
			'company.name' => [
				'data' => 'company.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'bank',
			'swift',
			'account',
			'iban',
			'default',
			'company.name',
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
			'company.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'company.id',
				'lists' => 'company.name',
			],
        ];
    }

	/**
	 * @param CompanyBankAccount $companyBankAccount
	 * @return array
	 */
	protected function getActions($companyBankAccount)
	{
		return parent::getActions($companyBankAccount);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }


    /**
     * @param CompanyBankAccount $companyBankAccount
     * @return string
     */
    public function renderCustomerTypes__NameColumn($companyBankAccount)
    {
        if ($this->isDataTableRequest()) {
            return $companyBankAccount->company ? $companyBankAccount->company->name : $this->renderDefaultView();
        }

        return $companyBankAccount->company->name;
    }
}
