<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Assembly;

/**
 * Assembly datatable.
 *
 * @package App\DataTables\Dashboard
 */
class AssemblyDataTable extends DataTable
{
    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'number' => [
                'searchable' => true
            ],
            'created_at',
            'updated_at',
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
            'number' => [
                'type' => 'text',
                'name' => 'number',
                'data' => 'number',
            ],
        ];
    }

    /**
     * @param Assembly $assembly
     * @return array
     */
    protected function getActions($assembly)
    {
        return [
            'assembly_list' => [
                'url' => route(sprintf('%s.%s.assembly_list', $this->prefix, $this->resource), $assembly->getKey()),
                'target' => '_blank',
                'icon' => 'dropbox',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.assembly_list.title', $this->resource)),
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
