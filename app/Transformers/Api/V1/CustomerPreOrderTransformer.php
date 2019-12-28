<?php

namespace App\Transformers\Api\V1;

use App\CustomerPreOrder;
use App\Transformers\Dashboard\CustomerOrderTransformer;
use App\Transformers\Dashboard\CustomerTransformer;
use App\Transformers\Dashboard\CustomerUserTransformer;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * CustomerPreOrder transformer.
 *
 * @package App\Transformers\Api\V1
 */
class CustomerPreOrderTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'number' => $request->get('number'),
            'reference_number' => $request->get('reference_number'),
            'comment' => $request->get('comment'),
            'customerUser' => (integer)$request->get('customerUser'),
            'customerOrder' => (integer)$request->get('customerOrder'),
            'customer' => (integer)$request->get('customer'),

        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'number' => $request->get('number'),
            'reference_number' => $request->get('reference_number'),
            'comment' => $request->get('comment'),
            'customerUser' => (integer)$request->get('customerUser'),
            'customerOrder' => (integer)$request->get('customerOrder'),
            'customer' => (integer)$request->get('customer'),

        ];
    }

    /**
     * @param CustomerPreOrder $customerPreOrder
     * @return array
     */
    public static function toArray($customerPreOrder)
    {
        return [
            'id' => (int)$customerPreOrder->getKey(),
            'number' => $customerPreOrder->number,
            'batch_number' => $customerPreOrder->reference_number,
            'comment' => $customerPreOrder->comment,
            'fc_overdue' => $customerPreOrder->customerOrder ? $customerPreOrder->customerOrder->fc_overdue : null,
            'fc_comment' => $customerPreOrder->customerOrder ? $customerPreOrder->customerOrder->fc_comment : null,
            'fc_future_comment' => $customerPreOrder->customerOrder ? $customerPreOrder->customerOrder->fc_future_comment : null,
            'sent_at' => null,
            'customer_id' => $customerPreOrder->customer ? $customerPreOrder->customer->id : null,
            'user_id' => $customerPreOrder->customerOrder ? $customerPreOrder->customerOrder->user->id : null,
            'status' => 'open',
            'amount' => $customerPreOrder->amount,
            'amount_vat' => $customerPreOrder->amount_vat,
            'type' => 'pre-order',

            'created_at' => (string)$customerPreOrder->created_at,
            'updated_at' => (string)$customerPreOrder->updated_at,
            'deleted_at' => (string)$customerPreOrder->deleted_at,
        ];
    }
}