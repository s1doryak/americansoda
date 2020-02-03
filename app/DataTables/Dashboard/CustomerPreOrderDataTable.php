<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerPreOrder;

/**
 * CustomerPreOrder datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerPreOrderDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'number',
			'comment',
			'customerUser.name' => [
				'data' => 'customerUser.name'
			],
			'customerOrder.number' => [
				'data' => 'customerOrder.number'
			],
			'customer.name' => [
				'data' => 'customer.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'number',
			'comment',
			'customerUser.name',
			'customerOrder.number',
			'customer.name',
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
			'customerUser.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customerUser.id',
				'lists' => 'customerUser.name',
			],
			'customerOrder.number' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customerOrder.id',
				'lists' => 'customerOrder.number',
			],
			'customer.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customer.id',
				'lists' => 'customer.name',
			],
			'items.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'items.id',
				'lists' => 'items.name',
			],
        ];
    }

	/**
	 * @param CustomerPreOrder $customerPreOrder
	 * @return array
	 */
	protected function getActions($customerPreOrder)
	{
		return parent::getActions($customerPreOrder);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param CustomerPreOrder $customerPreOrder
     * @return string
     */
    public function renderCustomerUser__NameColumn($customerPreOrder)
    {
        if ($this->isDataTableRequest()) {
            return $customerPreOrder->customerUser->name ?? $this->renderDefaultView();
        }

        return $customerPreOrder->customerUser->name ?? null;
    }

    /**
     * @param CustomerPreOrder $customerPreOrder
     * @return string
     */
    public function renderCustomerOrder__NumberColumn($customerPreOrder)
    {
        if ($this->isDataTableRequest()) {
            return $customerPreOrder->customerOrder->number ?? $this->renderDefaultView();
        }

        return $customerPreOrder->customerOrder->number ?? null;
    }

    /**
     * @param CustomerPreOrder $customerPreOrder
     * @return string
     */
    public function renderCustomer__NameColumn($customerPreOrder)
    {
        if ($this->isDataTableRequest()) {
            return $customerPreOrder->customer->name ?? $this->renderDefaultView();
        }

        return $customerPreOrder->customer->name ?? null;
    }
}
