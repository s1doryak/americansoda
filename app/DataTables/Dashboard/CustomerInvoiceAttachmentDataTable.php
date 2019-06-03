<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\CustomerInvoiceAttachment;

/**
 * CustomerInvoiceAttachment datatable.
 *
 * @package App\DataTables\Dashboard
 */
class CustomerInvoiceAttachmentDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'attachment_type',
			'filename',
			'file',
			'customerInvoice.name' => [
				'data' => 'customerInvoice.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'attachment_type',
			'filename',
			'file',
			'customerInvoice.name',
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
			'customerInvoice.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customerInvoice.id',
				'lists' => 'customerInvoice.name',
			],
        ];
    }

	/**
	 * @param CustomerInvoiceAttachment $customerInvoiceAttachment
	 * @return array
	 */
	protected function getActions($customerInvoiceAttachment)
	{
		return parent::getActions($customerInvoiceAttachment);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
