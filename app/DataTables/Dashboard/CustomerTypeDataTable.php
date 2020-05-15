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
    protected $responsive = false;

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
            'customerType.name',
            'action'
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

    /**
     * @param CustomerType $customerType
     * @return string
     */
    public function renderNameColumn($customerType)
    {
        if ($this->isDataTableRequest()) {
            return $customerType->customerType ? sprintf('%s / %s', $customerType->customerType->name, $customerType->name) : $customerType->name;
        }

        return $customerType->customerType->name ?? $customerType->name ?? null;
    }

    /**
     * @param CustomerType $customerType
     * @return string
     */
    public function renderCustomerType__NameColumn($customerType)
    {
        if ($this->isDataTableRequest()) {
            return $customerType->customerType->name ?? $this->renderDefaultView();
        }

        return $customerType->customerType->name ?? null;
    }
}
