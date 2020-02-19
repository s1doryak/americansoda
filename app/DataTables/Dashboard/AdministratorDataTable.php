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
            'locale',
            'phone',
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
    protected function getRawColumns()
    {
        return [
            'name',
            'locale',
            'email',
            'phone',
            'avatar',
            'role.name',
            'company.name',
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

    /**
     * @param Administrator $administrator
     * @return string
     */
    public function renderNameColumn($administrator)
    {
        if ($this->isDataTableRequest()) {

            if (isset($administrator->avatar->avatar) && $administrator->avatar->avatar->url) {
                $avatar = $administrator->avatar->avatar->url;
            } else {
                $avatar = sprintf(
                    "/vendor/material-admin/img/demo/profile-pics/%d.jpg",
                    ($administrator->getKey() % 9) + 1
                );
            }

            return $this->renderMediaView($administrator->name, $administrator->email, $avatar);
        }

        return $administrator->name;
    }

    /**
     * @param Administrator $administrator
     * @return string
     */
    public function renderRole__NameColumn($administrator)
    {
        if ($this->isDataTableRequest()) {
            return $administrator->role->name ?? $this->renderDefaultView();
        }

        return $administrator->role->name ?? null;
    }

    /**
     * @param Administrator $administrator
     * @return string
     */
    public function renderCompany__NameColumn($administrator)
    {
        if ($this->isDataTableRequest()) {
            return $administrator->company->name ?? $this->renderDefaultView();
        }

        return $administrator->company->name ?? null;
    }
}
