<?php

namespace App\Http\Requests\Api\V1\Setting;

use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
