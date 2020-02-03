<?php

namespace App\Http\Requests\Api\V1\CustomerShipment;

use App\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GetRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->customers()->where('customer_id', $this->route('id'))->exists();
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