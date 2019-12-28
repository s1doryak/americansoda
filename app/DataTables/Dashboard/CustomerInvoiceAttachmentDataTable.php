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
			'customerInvoice.order_nr' => [
				'data' => 'customerInvoice.order_nr'
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
			'customerInvoice.order_nr',
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
			'customerInvoice.order_nr' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customerInvoice.id',
				'lists' => 'customerInvoice.order_nr',
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

    /**
     * @param CustomerInvoiceAttachment $customerInvoiceAttachment
     * @return string
     */
    public function renderCustomerInvoice__OrderNrColumn($customerInvoiceAttachment)
    {
        if ($this->isDataTableRequest()) {
            return $customerInvoiceAttachment->customerInvoice->order_nr ?? $this->renderDefaultView();
        }

        return $customerInvoiceAttachment->customerInvoice->order_nr ?? null;
    }
}
