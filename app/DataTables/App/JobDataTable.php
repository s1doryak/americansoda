<?php

namespace App\DataTables\App;

use App\Job;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use Jenssegers\Date\Date;

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
    protected function getRawColumns()
    {
        return [
            'queue',
            'payload',
            'attempts',
            'reserved_at',
            'available_at',
            'created_at',
            'action'
        ];
    }

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
            'attempts' => [
                'function' => 'avg',
                'format' => '~%d %s',
                'format_args' => trans('models/job.formatting.aggregate.attempts')
            ],
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

    /**
     * @param integer $timestamp
     * @return string
     */
    protected function renderTimestamp($timestamp = null)
    {
        if ($timestamp) {
            $carbon = Carbon::createFromTimestamp($timestamp);

            $format = 'j F Y';
            $template = trans('models/job.formatting.timestamp.default');

            if ($carbon->isCurrentYear()) {
                $format = 'j F';
                $template = trans('models/job.formatting.timestamp.year');

                if ($carbon->isCurrentMonth()) {
                    $format = 'j F H:i';
                    $template = trans('models/job.formatting.timestamp.month');

                    if ($carbon->isCurrentDay()) {
                        $format = 'H:i:s';
                        $template = trans('models/job.formatting.timestamp.day');
                    }
                }
            }

            return sprintf($template, Date::parse($carbon)->format($format));
        }

        return view()->make('datatables::columns.default')->render();
    }

    /**
     * @param Job $job
     * @return string
     */
    protected function renderQueueColumn($job)
    {
        if ($this->isDataTableRequest()) {
            switch ($job->queue) {
                case 'download':
                    return $this->renderIconView($job->queue, 'download', 'c-blue');
                    break;
                case 'process':
                    return $this->renderIconView($job->queue, 'settings', 'c-orange');
                    break;
                default:
                    return $this->renderIconView($job->queue, 'time', 'c-green');
                    break;
            }
        }

        return $job->queue;
    }

    /**
     * @param Job $job
     * @return string
     */
    protected function renderPayloadColumn($job)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderView('app::resources.job.columns.payload', ['job' => $job]);
        }

        return $job->payload;
    }

    /**
     * @param Job $job
     * @return string
     */
    protected function renderAttemptsColumn($job)
    {
        $attempts = (integer)$job->attempts;

        if ($this->isDataTableRequest()) {
            if ($attempts <= 2) {
                return $this->renderBadgeView((string)$attempts, 'bgm-green');
            }

            if ($attempts <= 4) {
                return $this->renderBadgeView((string)$attempts, 'bgm-orange');
            }

            return $this->renderBadgeView((string)$attempts, 'bgm-red');
        }

        return (string)$attempts;
    }

    /**
     * @param Job $job
     * @return string
     */
    protected function renderReservedAtColumn($job)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderTimestamp($job->reserved_at);
        }

        return $job->reserved_at;
    }

    /**
     * @param Job $job
     * @return string
     */
    protected function renderAvailableAtColumn($job)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderTimestamp($job->available_at);
        }

        return $job->available_at;
    }

    /**
     * @param Job $job
     * @return string
     */
    protected function renderCreatedAtColumn($job)
    {
        if ($this->isDataTableRequest()) {
            return $this->renderTimestamp($job->created_at);
        }

        return $job->created_at;
    }
}
