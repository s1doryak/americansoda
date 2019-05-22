<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerShipment;

/**
 * CustomerShipment datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerShipmentDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'number',
				'assembly_number',
				'invoice_number',
				'status',
				'delivery_type',
				'packages_quantity',
				'comment',
				'packageType.name' => [
					'data' => 'packageType.name'
				],
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
				'packages_quantity',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
				'packageType.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'packageType.id',
					'lists' => 'packageType.name',
				],
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
	 * @param CustomerShipment $customerShipment
	 * @return array
	 */
	protected function getActions($customerShipment)
	{
		return parent::getActions($customerShipment);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
