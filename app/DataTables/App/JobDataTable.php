<?php

namespace App\DataTables\App;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Job;

/**
 * Job datatable.
 *
 * @package App\DataTables\App
 */
class JobDataTable extends DataTable
{
    /**
     * Get default row attributes.
     */
    protected function getRowAttributes()
    {
        return [
            'data-id' => function ($model) {
                return $model->getKey();
            },
        ];
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'queue',
            'payload',
            'attempts',
            'reserved_at',
            'available_at',
            'created_at',
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
            'attempts',
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
     * @param Job $job
     * @return array
     */
    protected function getActions($job)
    {
        return [
            'destroy' => [
                'url' => route(sprintf('%s.%s.destroy', $this->prefix, $this->resource), $job->getKey()),
                'icon' => 'close-circle',
                'color' => 'red',
                'title' => trans(sprintf('models/%s.destroy.title', $this->resource)),
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
