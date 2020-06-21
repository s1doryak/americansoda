<?php

namespace App\Http\Requests\Api\V1\CustomerInvoice;

use App\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DownloadPdfRequest extends FormRequest
{
    public function authorize()
    {
        $customerWithInvoices = Auth::user()
            ->customers()
            ->where('id', $this->route('id'))
            ->with(['customerInvoices' => function ($query) {
                return $query
                    ->where('customer_shipment_id', $this->route('shipment_id'));
            }])
            ->first();

        return $customerWithInvoices->customerInvoices->isNotEmpty();
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
