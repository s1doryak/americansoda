<?php

namespace App\Http\Requests\Api\V1\CustomerShipment;

use App\Customer;
use App\CustomerOrder;
use App\CustomerShipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DownloadPdfRequest extends FormRequest
{
    public function authorize()
    {
        $customerWithShipments = Auth::user()
            ->customers()
            ->where('customer_id', $this->route('id'))
            ->with(['customerShipments' => function ($query) {
                return $query->where('id', $this->route('shipment_id'));
            }])
            ->first();

        return $customerWithShipments->customerShipments->count() > 0;
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