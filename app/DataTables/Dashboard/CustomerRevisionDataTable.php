<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerRevision;

/**
 * CustomerRevision datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerRevisionDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
				'revision_type',
				'name',
				'legal_name',
				'billing_postcode',
				'billing_address',
				'shipping_postcode',
				'shipping_address',
				'bid',
				'iban',
				'swift',
				'email',
				'phone',
				'order_interval',
				'comment',
				'calendar_comment',
				'incomterms',
				'terms_of_cooperation',
				'terms_of_delivery',
				'terms_of_equipment',
				'delivery_payer',
				'payment_conditions',
				'pays_vat',
				'revision.name' => [
					'data' => 'revision.name'
				],
				'editor.name' => [
					'data' => 'editor.name'
				],
				'stock.name' => [
					'data' => 'stock.name'
				],
				'customerType.name' => [
					'data' => 'customerType.name'
				],
				'paymentType.name' => [
					'data' => 'paymentType.name'
				],
				'user.name' => [
					'data' => 'user.name'
				],
				'billingRegion.name' => [
					'data' => 'billingRegion.name'
				],
				'shippingRegion.name' => [
					'data' => 'shippingRegion.name'
				],
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
				'order_interval',
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
				'editor.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'editor.id',
					'lists' => 'editor.name',
				],
				'stock.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'stock.id',
					'lists' => 'stock.name',
				],
				'customerType.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'customerType.id',
					'lists' => 'customerType.name',
				],
				'paymentType.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'paymentType.id',
					'lists' => 'paymentType.name',
				],
				'user.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'user.id',
					'lists' => 'user.name',
				],
				'billingRegion.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'billingRegion.id',
					'lists' => 'billingRegion.name',
				],
				'shippingRegion.name' => [
					'type' => 'choice',
					'multiple' => true,
					'data' => 'shippingRegion.id',
					'lists' => 'shippingRegion.name',
				],
        ];
    }

	/**
	 * @param CustomerRevision $customerRevision
	 * @return array
	 */
	protected function getActions($customerRevision)
	{
		return parent::getActions($customerRevision);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
