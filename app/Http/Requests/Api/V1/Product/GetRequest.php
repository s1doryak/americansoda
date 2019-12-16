<?php

namespace App\Http\Requests\Api\V1\Product;

use App\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'sometimes|array',
            'ids.*' => 'integer|exists:products,id'
        ];
    }

    public function validateResolved()
    {
        parent::validateResolved();
        Customer::findOrFail($this->route('id'));
    }
}