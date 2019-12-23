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
            'name',
            'email',
            'phone',
            'customers.name',
            'comment',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'name',
            'email',
            'phone',
            'customers.name',
            'comment',
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
            /*'customers.name' => [
                'type' => 'choice',
                'multiple' => true,
                'data' => 'customers.id',
                'lists' => 'customers.name',
            ],*/
        ];
    }

    /**
     * @param CustomerUser $customerUser
     * @return array
     */
    protected function getActions($customerUser)
    {
        return array_merge(
            [
                'login' => [
                    'url' => route('redirect', ['to' => generateApiAuthLink($customerUser->token)]),
                    'target' => '_blank',
                    'icon' => 'account-circle',
                    'color' => 'blue',
                    'title' => trans('models/customer_user.login.title'),
                ],
            ],
            parent::getActions($customerUser)
        );
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param CustomerUser $customerUser
     * @return string
     */
    protected function renderCustomers__NameColumn($customerUser)
    {
        if ($this->isDataTableRequest()) {
            return $customerUser->customers->pluck('name')->implode('<br>');
        }

        return $customerUser->customers->pluck('name')->implode(', ');
    }
}
