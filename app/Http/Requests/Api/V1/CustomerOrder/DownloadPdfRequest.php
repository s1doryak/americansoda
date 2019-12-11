<?php

namespace App\Http\Requests\Api\V1\CustomerOrder;

use App\Customer;
use App\CustomerOrder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DownloadPdfRequest extends FormRequest
{
    public function authorize()
    {
        CustomerOrder::findOrFail($this->route('order_id'));
        $customerUser = Auth::user()
            ->customers()
            ->with(['customerOrders' => function ($query) {
                return $query->where('id', $this->route('order_id'));
            }])
            ->first();

        return $customerUser->customerOrders->count() > 0;
    }

    public function rules()
    {
        return [];
    }

    public function validateResolved()
    {
        parent::validateResolved();
        Customer::findOrFail($this->route('id'));
    }
}