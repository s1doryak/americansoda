<?php

namespace App\Transformers\Dashboard;

use App\CustomerInvoiceAction;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerInvoiceAction transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CustomerInvoiceActionTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'action' => $request->get('action'),
			'timestamp' => $request->get('timestamp'),
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
			'action' => $request->get('action'),
			'timestamp' => $request->get('timestamp'),
			'customerInvoice' => (integer)$request->get('customerInvoice'),

		];
	}

	/**
	 * @param CustomerInvoiceAction $customerInvoiceAction
	 * @return array
	 */
	public static function toArray($customerInvoiceAction)
	{
		return [
			'id' => (int)$customerInvoiceAction->getKey(),
			'action' => $customerInvoiceAction->action,
			'timestamp' => $customerInvoiceAction->timestamp,
			'customerInvoice' => $customerInvoiceAction->customerInvoice ? CustomerInvoiceTransformer::toArray($customerInvoiceAction->customerInvoice) : null,

			'created_at' => (string)$customerInvoiceAction->created_at,
			'updated_at' => (string)$customerInvoiceAction->updated_at,
			'deleted_at' => (string)$customerInvoiceAction->deleted_at,
		];
	}
}