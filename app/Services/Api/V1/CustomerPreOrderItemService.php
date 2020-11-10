<?php

namespace App\Services\Api\V1;

use App\Product;
use App\Repositories\Eloquent\CustomerPreOrderItemRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Exceptions\ValidatorException;

class CustomerPreOrderItemService extends ResourceService
{
    /**
     * @var CustomerPreOrderItemRepositoryEloquent
     */
    protected $repository;

    /**
     * @var CustomerPricingPolicyService
     */
    protected $customerPricingPolicyService;

    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * CustomerPreOrderItemService constructor.
     * @param CustomerPreOrderItemRepositoryEloquent $repository
     * @param ProductService $productService
     * @param CustomerPricingPolicyService $customerPricingPolicyService
     */
    public function __construct(
        CustomerPreOrderItemRepositoryEloquent $repository,
        ProductService $productService,
        CustomerPricingPolicyService $customerPricingPolicyService
    )
    {
        $this->repository = $repository;
        $this->productService = $productService;
        $this->customerPricingPolicyService = $customerPricingPolicyService;
    }

    /**
     * @param $preOrderItems array|Collection
     * @param $customerPreOrder array|Collection
     * @throws ValidatorException
     */
    public function create($preOrderItems, $customerPreOrder)
    {
        $customerPreOrderItems = $this->makeCustomerOrderItemsData($preOrderItems, $customerPreOrder);

        foreach ($customerPreOrderItems as $customerPreOrderItem) {
            $this->repository->create($customerPreOrderItem);
        }

    }

    /**
     * @param array|Collection $preOrderItems
     * @param array|Collection $customerPreOrder
     * @return array
     */
    public function makeCustomerOrderItemsData($preOrderItems, $customerPreOrder)
    {
        $customerPreOrderItems = [];
        $preOrderItemsCustomerData = [
            'customer_pre_order_id' => $customerPreOrder->id,
            'customer_user_id' => Auth::id(),
            'customer_id' => $customerPreOrder->customer_id
        ];
        $preOrderItemsQuantity = $this->getTotalSalesUnitQuantity($preOrderItems);

        foreach ($preOrderItems as $preOrderItem) {
            $customerPreOrderItems[] = array_merge(
                $preOrderItemsCustomerData,
                $preOrderItem,
                $this->getCalculatedFields($preOrderItem, $customerPreOrder->customer_id, $preOrderItemsQuantity)
            );
        }

        return $customerPreOrderItems;
    }

    /**
     * @param array $preOrderItem
     * @param integer $customerId
     * @param $preOrderItemsQuantity
     * @return array
     */
    protected function getCalculatedFields($preOrderItem, $customerId, $preOrderItemsQuantity)
    {
        /** @var Product $product */
        $product = $this->productService->with('productGroup')->find($preOrderItem['product_id']);
        $productGroup = $product->productGroup;
        $price = $product->discount_price
            ? $product->discount_price
            : $this->customerPricingPolicyService->getPriceBySalesUnitQuantity($preOrderItemsQuantity, $customerId, $productGroup->id);
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
            'price' => round($price, 8),
            'vat_price' => round($price + ($price * ($productGroup->vat / 100)), 2),
            'products_quantity' => round($productsQuantity, 2),
            'total_price' => round($totalPrice, 2),
            'total_vat_price' => round($totalVatPrice, 2),
            'deposit_price' => round($depositPrice, 2),
            'deposit_vat_price' => round($depositVatPrice, 2),
            'deposit_total_price' => round($depositTotalPrice, 2),
            'deposit_total_vat_price' => round($depositTotalVatPrice, 2)
        ];
    }

    /**
     * @param Collection $items
     *
     * @return mixed
     */
    protected function getTotalSalesUnitQuantity($items)
    {
        return collect($items)->filter(function ($item) {
            return false === booleanize($item['_remove'] ?? false);
        })->sum('quantity');
    }
}
