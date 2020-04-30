<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\CustomerPreOrderItemRepository;
use App\Repositories\Eloquent\CustomerPreOrderItemRepositoryEloquent;
use App\Repositories\Eloquent\CustomerPricingPolicyRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Arr;
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
        $product = $this->productService->with('productGroup')->find($preOrderItem['product_id']);
        $productGroup = $product->productGroup;
        $price = $this->customerPricingPolicyService->getPriceBySalesUnitQuantity($preOrderItemsQuantity, $customerId, $productGroup->id);
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
            'vat_price' => sprintf('%.2f', $price + ($price * ($productGroup->vat / 100))),
            'products_quantity' => $productsQuantity,
            'total_price' => $totalPrice,
            'total_vat_price' => sprintf('%.2f', $totalVatPrice),
            'deposit_price' => $depositPrice,
            'deposit_vat_price' => $depositVatPrice,
            'deposit_total_price' => $depositTotalPrice,
            'deposit_total_vat_price' => $depositTotalVatPrice
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
