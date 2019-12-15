<?php

namespace App\Http\Requests\Api\V1\CustomerOrder;

use App\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DownloadPdfRequest extends FormRequest
{
    public function authorize()
    {
        $customerUser = Auth::user()
            ->customers()
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

    public function validateResolved()
    {
        parent::validateResolved();
        Customer::findOrFail($this->route('id'));
    }
}