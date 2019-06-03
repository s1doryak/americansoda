<?php

namespace App\Transformers\Dashboard;

use App\CustomerInvoiceAttachment;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerInvoiceAttachment transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerInvoiceAttachmentTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'attachment_type' => $request->get('attachment_type'),
			'filename' => $request->get('filename'),
			'file' => $request->get('file'),
			'customerInvoice' => (integer)$request->get('customerInvoice'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'attachment_type' => $request->get('attachment_type'),
			'filename' => $request->get('filename'),
			'file' => $request->get('file'),
			'customerInvoice' => (integer)$request->get('customerInvoice'),

		];
	}

	/**
	 * @param CustomerInvoiceAttachment $customerInvoiceAttachment
	 * @return array
	 */
	public static function toArray($customerInvoiceAttachment)
	{
		return [
			'id' => (int)$customerInvoiceAttachment->getKey(),
			'attachment_type' => $customerInvoiceAttachment->attachment_type,
			'filename' => $customerInvoiceAttachment->filename,
			'file' => $customerInvoiceAttachment->file,
			'customerInvoice' => $customerInvoiceAttachment->customerInvoice ? CustomerInvoiceTransformer::toArray($customerInvoiceAttachment->customerInvoice) : null,

			'created_at' => (string)$customerInvoiceAttachment->created_at,
			'updated_at' => (string)$customerInvoiceAttachment->updated_at,
			'deleted_at' => (string)$customerInvoiceAttachment->deleted_at,
		];
	}
}