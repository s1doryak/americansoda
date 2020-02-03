<?php

namespace App\Http\Requests\Api\V1\CustomerOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CopyRequest extends FormRequest
{
    public function authorize()
    {
        $customerUser = Auth::user()
            ->customers()
            ->where('customer_id', $this->route('id'))
            ->with(['customerOrders' => function ($query) {
                return $query->where('id', $this->route('order_id'));
            }])
            ->first();

        return $customerUser->customerOrders->isNotEmpty();
    }

    public function rules()
    {
        return [];
    }
}