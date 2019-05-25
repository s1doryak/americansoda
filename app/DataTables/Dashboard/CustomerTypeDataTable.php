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
    protected function renderCustomerType__NameColumn($customerType)
    {
        $customerTypeName = $customerType->customerType ? $customerType->customerType->name : null;

        if ($customerTypeName) {
            return $customerTypeName;
        } else {
            return $this->renderView('datatables::columns.default');
        }
    }

}
