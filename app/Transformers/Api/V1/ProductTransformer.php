<?php

namespace App\Transformers\Api\V1;

use App\Product;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Product transformer.
 *
 * @package App\Transformers\Api\V1
 */
class ProductTransformer implements TransformerContract
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
            'product_barcode' => $request->get('product_barcode'),
            'product_barcode_plaintext' => $request->get('product_barcode_plaintext'),
            'package_barcode' => $request->get('package_barcode'),
            'package_barcode_plaintext' => $request->get('package_barcode_plaintext'),
            'product_image' => $request->file('product_image'),
            'package_image' => $request->file('package_image'),
            'description' => $request->get('description'),
            'contents' => $request->get('contents'),
            'number_in_package' => (integer)$request->get('number_in_package'),
            'unit_type' => $request->get('unit_type'),
            'weight' => $request->get('weight'),
            'volume' => $request->get('volume'),
            'brutto_weight' => $request->get('brutto_weight'),
            'brutto_volume' => $request->get('brutto_volume'),
            'deposit_enabled' => (boolean)$request->get('deposit_enabled'),
            'deposit_price' => $request->get('deposit_price'),
            'deposit_vat' => (integer)$request->get('deposit_vat'),
            'deposit_vat_price' => $request->get('deposit_vat_price'),
            'comment' => $request->get('comment'),
            'brand' => (integer)$request->get('brand'),
            'packageType' => (integer)$request->get('packageType'),
            'productGroup' => (integer)$request->get('productGroup'),
            'productTags' => (array)$request->get('productTags'),
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
            'product_barcode' => $request->get('product_barcode'),
            'product_barcode_plaintext' => $request->get('product_barcode_plaintext'),
            'package_barcode' => $request->get('package_barcode'),
            'package_barcode_plaintext' => $request->get('package_barcode_plaintext'),
            'product_image' => $request->file('product_image'),
            'package_image' => $request->file('package_image'),
            'description' => $request->get('description'),
            'contents' => $request->get('contents'),
            'number_in_package' => (integer)$request->get('number_in_package'),
            'unit_type' => $request->get('unit_type'),
            'weight' => $request->get('weight'),
            'volume' => $request->get('volume'),
            'brutto_weight' => $request->get('brutto_weight'),
            'brutto_volume' => $request->get('brutto_volume'),
            'deposit_enabled' => (boolean)$request->get('deposit_enabled'),
            'deposit_price' => $request->get('deposit_price'),
            'deposit_vat' => (integer)$request->get('deposit_vat'),
            'deposit_vat_price' => $request->get('deposit_vat_price'),
            'comment' => $request->get('comment'),
            'brand' => (integer)$request->get('brand'),
            'packageType' => (integer)$request->get('packageType'),
            'productGroup' => (integer)$request->get('productGroup'),
            'productTags' => (array)$request->get('productTags'),
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    public static function toArray($product)
    {
        if (is_null($product->product_image)) {
            $productImage = ($product->productGroup->image)
                ? $product->productGroup->image
                : $product->productGroup->productType->image;
        } else {
            $productImage = $product->product_image;
        }

        return [
            'id' => (int)$product->getKey(),
            'name' => $product->name,
            'product_barcode' => $product->product_barcode,
            'product_barcode_plaintext' => $product->product_barcode_plaintext,
            'package_barcode' => $product->package_barcode,
            'package_barcode_plaintext' => $product->package_barcode_plaintext,
            'product_image' => (string)$productImage ? asset((string)$productImage) : null,
            'package_image' => (string)$product->package_image ? asset((string)$product->package_image) : null,
            'description' => $product->description,
            'contents' => $product->contents,
            'number_in_package' => (integer)$product->number_in_package,
            'unit_type' => (string)$product->unit_type,
            'weight' => $product->weight,
            'volume' => $product->volume,
            'brutto_weight' => $product->brutto_weight,
            'brutto_volume' => $product->brutto_volume,
            'deposit_enabled' => (boolean)$product->deposit_enabled,
            'deposit_price' => $product->deposit_price,
            'deposit_vat' => (integer)$product->deposit_vat,
            'deposit_vat_price' => $product->deposit_vat_price,
            'comment' => $product->comment,
            'brand_id' => $product->brand->id,
            'packageType' => $product->packageType->id,
            'productGroup' => $product->productGroup->id,
            'productTags' => $product->productTags,

            'created_at' => (string)$product->created_at,
            'updated_at' => (string)$product->updated_at,
            'deleted_at' => (string)$product->deleted_at,
        ];
    }
}
