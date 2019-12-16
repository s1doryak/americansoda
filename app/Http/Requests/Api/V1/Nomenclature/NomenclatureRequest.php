<?php

namespace App\Http\Requests\Api\V1\Nomenclature;

use App\Customer;
use Illuminate\Foundation\Http\FormRequest;

class NomenclatureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'with_count' => 'array',
            'with_count.*' => 'in:' . $this->getRelations()
        ];
    }

    public function validateResolved()
    {
        parent::validateResolved();
        Customer::findOrFail($this->route('id'));
    }

    protected function getRelations()
    {
        return implode(',', [
            'products',
            'pricingPolicies'
        ]);
    }
}