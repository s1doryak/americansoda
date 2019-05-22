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
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'number',
				'batch_number',
				'comment',
				'fc_overdue',
				'fc_comment',
				'fc_future_comment',
				'sent_at',
				'customer.name' => [
					'data' => 'customer.name'
				],
				'user.name' => [
					'data' => 'user.name'
				],
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
				'fc_overdue',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
				'customer.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customer.id',
					'lists' => 'customer.name',
				],
				'user.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'user.id',
					'lists' => 'user.name',
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
}
