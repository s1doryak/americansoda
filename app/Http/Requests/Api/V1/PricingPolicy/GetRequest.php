<?php

namespace App\Http\Requests\Api\V1\PricingPolicy;

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
        return [
            'ids' => 'sometimes|array',
            'ids.*' => 'integer|exists:customer_pricing_policies,id'
        ];
    }

    public function validateResolved()
    {
        parent::validateResolved();
        Customer::findOrFail($this->route('id'));
    }
}