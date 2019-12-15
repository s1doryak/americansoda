<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\CustomerPreOrderItemRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Facades\Auth;

class CustomerPreOrderItemService extends ResourceService
{
    protected $customerPricingPolicyService;
    protected $productService;

    public function __construct()
    {
        $this->setRepository(CustomerPreOrderItemRepositoryEloquent::class);

        $this->productService = app(ProductService::class);
        $this->customerPricingPolicyService = app(CustomerPricingPolicyService::class);
    }

    public function create($preOrderItems, $customerPreOrder)
    {
        $customerPreOrderItems = $this->makeCustomerOrderItemsData($preOrderItems, $customerPreOrder);

        foreach ($customerPreOrderItems as $customerPreOrderItem) {
            $this->repository->create($customerPreOrderItem);
        }

    }

    public function makeCustomerOrderItemsData($preOrderItems, $customerPreOrder)
    {
        $customerPreOrderItems = [];
        $preOrderItemsCustomerData = [
            'customer_pre_order_id' => $customerPreOrder->id,
            'customer_user_id' => Auth::id(),
            'customer_id' => $customerPreOrder->customer_id
        ];

        foreach ($preOrderItems as $preOrderItem) {
            $customerPreOrderItems[] = array_merge(
                $preOrderItemsCustomerData,
                $preOrderItem,
                $this->getCalculatedFields($preOrderItem, $customerPreOrder->id)
            );
        }

        return $customerPreOrderItems;
    }

    protected function getCalculatedFields($preOrderItem, $customerId)
    {
        $product = $this->productService->with('productGroup')->find($preOrderItem['product_id']);
        $productGroup = $product->productGroup;
        $price = $this->customerPricingPolicyService->getPriceBySalesUnitQuantity($preOrderItem['quantity'], $customerId, $productGroup->id);
        $packagesQuantity = $preOrderItem['quantity'] * $productGroup->sales_unit_volume / $product->number_in_package;
        $productsQuantity = $packagesQuantity * $product->number_in_package;
        $totalPrice = $price * $productsQuantity;
        $totalVatPrice = $totalPrice + ($totalPrice * ($productGroup->vat / 100));

        $depositPrice = (float)$product->deposit_price;
        $depositVat = (int)$product->deposit_vat;
        $depositVatPrice = $depositPrice + ($depositPrice * ($depositVat / 100));

        $depositTotalPrice = $productsQuantity * $depositPrice;
        $depositTotalVatPrice = $productsQuantity * $depositVatPrice;

        return [
            'price' => $price,
            'vat_price' => $price + ($price * ($productGroup->vat / 100)),
            'products_quantity' => $productsQuantity,
            'total_price' => $totalPrice,
            'total_vat_price' => $totalVatPrice,
            'deposit_price' => $depositPrice,
            'deposit_vat_price' => $depositVatPrice,
            'deposit_total_price' => $depositTotalPrice,
            'deposit_total_vat_price' => $depositTotalVatPrice
        ];
    }
}