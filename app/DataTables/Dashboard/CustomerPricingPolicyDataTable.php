<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerPricingPolicy;

/**
 * CustomerPricingPolicy datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerPricingPolicyDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'products_range',
				'price',
				'productGroup.name' => [
					'data' => 'productGroup.name'
				],
				'customer.name' => [
					'data' => 'customer.name'
				],
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
				'products_range',
				'price',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
				'productGroup.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'productGroup.id',
					'lists' => 'productGroup.name',
				],
				'customer.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customer.id',
					'lists' => 'customer.name',
				],
        ];
    }

	/**
	 * @param CustomerPricingPolicy $customerPricingPolicy
	 * @return array
	 */
	protected function getActions($customerPricingPolicy)
	{
		return parent::getActions($customerPricingPolicy);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
