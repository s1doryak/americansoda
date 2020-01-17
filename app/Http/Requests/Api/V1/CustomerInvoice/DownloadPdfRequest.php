<?php

namespace App\Http\Requests\Api\V1\CustomerInvoice;

use App\Customer;
use App\CustomerOrder;
use App\CustomerShipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DownloadPdfRequest extends FormRequest
{
    public function authorize()
    {
        $customerWithInvoices = Auth::user()
            ->customers()
            ->with(['customerInvoices' => function ($query) {
                return $query
                    ->where('customer_id', $this->route('id'))
                    ->where('customer_shipment_id', $this->route('shipment_id'));
            }])
            ->first();

        return $customerWithInvoices->customerInvoices->count() > 0;
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