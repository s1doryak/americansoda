<?php

namespace App\Transformers\Api\V1;

use App\ProductType;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;

/**
 * ProductType transformer.
 *
 * @package App\Transformers\Api\V1
 */
class ProductTypeTransformer implements TransformerContract
{
    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'name' => $request->get('name'),
            'image' => $request->file('image'),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'name' => $request->get('name'),
            'image' => $request->file('image'),
        ];
    }


    /**
     * @param ProductType $productType
     * @return array
     */
    public static function toArray($productType)
    {
        return [
            'id' => (int)$productType->getKey(),
            'name' => $productType->name,
            'created_at' => (string)$productType->created_at,
            'updated_at' => (string)$productType->updated_at,
            'deleted_at' => (string)$productType->deleted_at,
            'image' => (string)$productType->image ? asset((string)$productType->image) : null,
        ];
    }
}