<?php

namespace App\DataTables\Dashboard;

use App\FailedJob;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use Jenssegers\Date\Date;

/**
 * FailedJob datatable.
 *
 * @package App\DataTables\Dashboard
 */
class FailedJobDataTable extends DataTable
{
    protected $responsive = false;

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
            'connection',
            'queue',
            'payload',
            'exception',
            'failed_at',
        ];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return [
            'connection',
            'queue',
            'payload',
            'exception',
            'failed_at',
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
     * @param FailedJob $failedJob
     * @return array
     */
    protected function getActions($failedJob)
    {
        return [
            'destroy' => [
                'url' => route(sprintf('%s.%s.destroy', $this->prefix, $this->resource), $failedJob->getKey()),
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

    /**
     * @param integer $timestamp
     * @return string
     */
    public function renderTimestamp($timestamp = null)
    {
        if ($timestamp) {
            $carbon = Carbon::createFromTimestamp($timestamp);

            $format = 'j F Y';
            $template = trans('models/failed_job.formatting.timestamp.default');

            if ($carbon->isCurrentYear()) {
                $format = 'j F';
                $template = trans('models/failed_job.formatting.timestamp.year');

                if ($carbon->isCurrentMonth()) {
                    $format = 'j F H:i';
                    $template = trans('models/failed_job.formatting.timestamp.month');

                    if ($carbon->isCurrentDay()) {
                        $format = 'H:i:s';
                        $template = trans('models/failed_job.formatting.timestamp.day');
                    }
                }
            }

            return sprintf($template, Date::parse($carbon)->format($format));
        }

        return view()->make('datatables::columns.default')->render();
    }

    /**
     * @param FailedJob $failedJob
     * @return string
     */
    public function renderConnectionColumn($failedJob)
    {
        if ($this->isDataTableRequest()) {
            switch ($failedJob->connection) {
                case 'sync':
                    return $this->renderIconView($failedJob->connection, 'swap', 'c-blue');
                    break;
                case 'database':
                    return $this->renderIconView($failedJob->connection, 'storage', 'c-green');
                    break;
                case 'sqs':
                    return $this->renderIconView($failedJob->connection, 'amazon', 'c-yellow');
                    break;
                case 'redis':
                    return $this->renderIconView($failedJob->connection, 'storage', 'c-red');
                    break;
                default:
                    return $this->renderIconView($failedJob->connection, 'storage', 'c-green');
                    break;
            }
        }

        return $failedJob->connection;
    }

    /**
     * @param FailedJob $failedJob
     * @return string
     */
    public function renderQueueColumn($failedJob)
    {
        if ($this->isDataTableRequest()) {
            switch ($failedJob->queue) {
                case 'download':
                    return $this->renderIconView($failedJob->queue, 'download', 'c-blue');
                    break;
                case 'process':
                    return $this->renderIconView($failedJob->queue, 'settings', 'c-orange');
                    break;
                default:
                    return $this->renderIconView($failedJob->queue, 'time', 'c-green');
                    break;
            }
        }

        return $failedJob->queue;
    }

    /**
     * @param FailedJob $failedJob
     * @return string
     */
    public function renderPayloadColumn($failedJob)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderView('dashboard::resources.failed_job.columns.payload', ['failedJob' => $failedJob]);
        }

        return $failedJob->payload;
    }

    /**
     * @param FailedJob $failedJob
     * @return string
     */
    public function renderExceptionColumn($failedJob)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderView('dashboard::resources.failed_job.columns.exception', ['failedJob' => $failedJob]);
        }

        return $failedJob->exception;
    }

    /**
     * @param FailedJob $failedJob
     * @return string
     */
    public function renderFailedAtColumn($failedJob)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderTimestamp($failedJob->failed_at->getTimestamp());
        }

        return $failedJob->failed_at;
    }
}
