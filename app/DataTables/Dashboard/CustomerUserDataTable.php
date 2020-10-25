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
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => [
                'searchable' => true,
            ],
            'email',
            'phone',
            'customers.name' => [
                'searchable' => true,
            ],
            'comment',
            'loggable',
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
            'loggable',
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
        $customers = $customerUser->customers ?? null;
        $customerNames = $customers ? $customers->pluck('name') : null;

        if ($this->isDataTableRequest()) {
            return $customerNames ? $customerNames->implode('<br>') : $this->renderDefaultView();
        }

        return $customerNames ? $customerNames->implode(', ') : null;
    }

    /**
     * @param CustomerUser $customerUser
     * @return string
     */
    protected function renderLoggableColumn($customerUser)
    {
        $lastLog = $customerUser->getLastAuthLog();

        if ($this->isDataTableRequest()) {
            return $lastLog ? format_date($lastLog->date) : $this->renderDefaultView();
        }

        return $lastLog ? format_date($lastLog->date) : null;
    }
}
