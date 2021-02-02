<?php

namespace App\Http\Requests\Api\V1\CustomerUserSubscribe;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()
            ->customerUserSubscribes
            ->filter(function ($CustomerUserSubscribe) {
                return $CustomerUserSubscribe->id == $this->route('subscription');
            })
            ->isNotEmpty();
    }

    public function rules()
    {
        return [
        ];
    }
}
