<?php

namespace App\Transformers\Api\V1;

use App\ProductGroup;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * ProductGroup transformer.
 *
 * @package App\Transformers\Api\V1
 */
class ProductGroupTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'name' => $request->get('name'),
            'vat' => (integer)$request->get('vat'),
            'sales_unit_volume' => (integer)$request->get('sales_unit_volume'),
            'productType' => (integer)$request->get('productType'),
            'image' => $request->file('image'),
            'info' => $request->get('info'),
            'banner' => $request->file('banner'),
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
            'vat' => (integer)$request->get('vat'),
            'sales_unit_volume' => (integer)$request->get('sales_unit_volume'),
            'productType' => (integer)$request->get('productType'),
            'image' => $request->file('image'),
            'info' => $request->get('info'),
            'banner' => $request->file('banner'),
        ];
    }

    /**
     * @param ProductGroup $productGroup
     * @return array
     */
    public static function toArray($productGroup)
    {
        return [
            'id' => (int)$productGroup->getKey(),
            'name' => $productGroup->name,
            'vat' => (integer)$productGroup->vat,
            'sales_unit_volume' => (integer)$productGroup->sales_unit_volume,
            'product_type_id' => $productGroup->productType->id ?? null,
            'created_at' => (string)$productGroup->created_at,
            'updated_at' => (string)$productGroup->updated_at,
            'deleted_at' => (string)$productGroup->deleted_at,
        ];
    }

    /**
     * @param ProductGroup $productGroup
     * @return array
     */
    public static function toArrayInfo($productGroup)
    {
        return [
            'image' => (string)$productGroup->image ? asset($productGroup->image->getByDimension('image')) : null,
            'info' => $productGroup->info,
            'banner' => (string)$productGroup->banner ? asset($productGroup->banner->getByDimension('banner')) : null,
        ];
    }
}
