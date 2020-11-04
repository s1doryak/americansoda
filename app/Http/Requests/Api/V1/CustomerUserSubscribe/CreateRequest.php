<?php

namespace App\Http\Requests\Api\V1\CustomerUserSubscribe;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required|integer|exists:products,id'
        ];
    }
}
