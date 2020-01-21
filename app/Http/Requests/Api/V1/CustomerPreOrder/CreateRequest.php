<?php

namespace App\Http\Requests\Api\V1\CustomerPreOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->customers()->where('customer_id', $this->route('id'))->exists();
    }

    public function rules()
    {
        return [
            'number' => 'sometimes|string',
            'reference_number' => 'sometimes|string',
            'comment' => 'sometimes|string',
            'pre_order_items' => 'required|array',
            'pre_order_items.*.product_id' => 'required|integer|exists:products,id',
            'pre_order_items.*.quantity' => 'required|string',
        ];
    }
}