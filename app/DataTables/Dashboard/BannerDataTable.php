<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Banner;

/**
 * Banner datatable.
 *
 * @package App\DataTables\Dashboard
 */
class BannerDataTable extends DataTable
{
    protected $responsive = false;

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name',
            'customerTypes.name' => [
                'data' => 'customerTypes.name',
                'orderable' => false
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
            'customerTypes.name',
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
//			'customerTypes.name' => [
//				'type' => 'choice',
//				'multiple' => true,
//				'operator' => 'in',
//				'data' => 'customerTypes.id',
//				'lists' => 'customerTypes.name',
//			],
        ];
    }

    /**
     * @param Banner $banner
     * @return array
     */
    protected function getActions($banner)
    {
        return parent::getActions($banner);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param Banner $banner
     * @return string
     */
    public function renderNameColumn($banner)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderMediaView($banner->name, $banner->url, $banner->image);
        }

        return $banner->name;
    }

    /**
     * @param Banner $banner
     * @return string
     */
    public function renderCustomerTypes__NameColumn($banner)
    {
        $customerTypes = $banner->customerTypes ?? null;
        $customerTypeNames = $customerTypes ? $customerTypes->pluck('name') : null;

        if ($this->isDataTableRequest()) {
            return $customerTypeNames ? $customerTypeNames->implode('<br>') : $this->renderDefaultView();
        }

        return $customerTypeNames ? $customerTypeNames->implode(', ') : null;
    }
}
