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
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => [
                'searchable' => true
            ],
            'email' => [
                'searchable' => true
            ],
            'phone' => [
                'searchable' => true
            ],
            'role.name' => [
                'data' => 'role.name',
            ],
            'company.name' => [
                'data' => 'company.name',
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
            'email',
            'phone',
            'role.name',
            'company.name',
            'created_at',
            'updated_at',
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

    /**
     * @param User $user
     * @return string
     */
    public function renderRole__NameColumn($user)
    {
        if ($this->isDataTableRequest()) {
            return $user->role->name ?? $this->renderDefaultView();
        }

        return $user->role->name ?? null;
    }

    /**
     * @param User $user
     * @return string
     */
    public function renderCompany__NameColumn($user)
    {
        if ($this->isDataTableRequest()) {
            return $user->company->name ?? $this->renderDefaultView();
        }

        return $user->company->name ?? null;
    }
}
