<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerOrder;

/**
 * CustomerOrder datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerOrderDataTable extends DataTable
{
    /**
     * DataTables using Eloquent Builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder|mixed $builder
     * @return \Crmplease\MaterialAdmin\DataTables\EloquentDataTable
     */
    public function eloquent($builder)
    {
        return parent::eloquent($builder)->orderColumn('number', 'SOUNDEX(number) $1, LENGTH(number) $1, number $1')
            ->orderColumn('batch_number', 'SOUNDEX(batch_number) $1, LENGTH(batch_number) $1, batch_number $1');
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            'number' => [
                'searchable' => true,
            ],
            'batch_number' => [
                'searchable' => true,
            ],
            'customer.order_interval' => [
                'data' => 'customer.order_interval',
                'name' => 'customer.order_interval',
            ],
            'customer.name' => [
                'data' => 'customer.name',
                'name' => 'customer.name',
                'searchable' => true,
            ],
            'sent_at',
            'user.name' => [
                'data' => 'user.name',
                'name' => 'user.name',
            ],
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return array
     */
    public function getRawColumns()
    {
        return [
            'name',
            'number',
            'sent_at',
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
            'customer.name' => [
                'type' => 'select',
                'multiple' => true,
                'name' => 'customer.id',
                'lists' => 'customer.name',
            ],
            'number' => [
                'type' => 'text',
                'name' => 'number',
                'data' => 'number',
            ],
        ];
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return array
     */
    protected function getActions($customerOrder)
    {
        return parent::getActions($customerOrder);
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return string
     * @throws \Throwable
     */
    protected function renderSentAtColumn($customerOrder)
    {
        $actions = [
            'send_email' => [
                'url' => route(sprintf('%s.%s.send_email', $this->prefix, $this->resource), $customerOrder->getKey()),
                'icon' => 'email',
                'color' => 'primary',
                'title' => trans(sprintf('models/%s.send_email.title', $this->resource)),
            ],
        ];

        if ($customerOrder->sent_at) {
            return format_date($customerOrder->sent_at);
        } else {
            return $this->renderActionView($actions, $customerOrder);
        }
    }
}
