<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerPricingPolicyRevision;

/**
 * CustomerPricingPolicyRevision datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerPricingPolicyRevisionDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'revision_type',
				'revision_number',
				'products_range',
				'price',
				'revision.name' => [
					'data' => 'revision.name'
				],
				'customerPricingPolicy.name' => [
					'data' => 'customerPricingPolicy.name'
				],
				'editor.name' => [
					'data' => 'editor.name'
				],
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
				'revision_number',
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
				'revision.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'revision.id',
					'lists' => 'revision.name',
				],
				'customerPricingPolicy.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customerPricingPolicy.id',
					'lists' => 'customerPricingPolicy.name',
				],
				'editor.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'editor.id',
					'lists' => 'editor.name',
				],
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
	 * @param CustomerPricingPolicyRevision $customerPricingPolicyRevision
	 * @return array
	 */
	protected function getActions($customerPricingPolicyRevision)
	{
		return parent::getActions($customerPricingPolicyRevision);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
