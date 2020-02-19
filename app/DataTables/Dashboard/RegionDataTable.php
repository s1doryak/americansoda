<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Region;

/**
 * Region datatable.
 *
 * @package App\DataTables\Dashboard
 */
class RegionDataTable extends DataTable
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

        ];
    }

    /**
     * @param Region $region
     * @return array
     */
    protected function getActions($region)
    {
        return parent::getActions($region);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
