<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\CustomerPreOrderRepository;
use App\Repositories\Eloquent\CustomerPreOrderRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CustomerPreOrderService extends ResourceService
{
    /**
     * @var CustomerPreOrderRepositoryEloquent
     */
    protected $repository;

    /**
     * @var CustomerPreOrderItemService
     */
    protected $customerPreOrderItemsService;

    /**
     * @var CustomerOrderService
     */
    protected $customerOrderService;

    public function __construct()
    {
        $this->setRepository(CustomerPreOrderRepository::class);

        $this->customerPreOrderItemsService = app(CustomerPreOrderItemService::class);
        $this->customerOrderService = app(CustomerOrderService::class);
    }

    public function create(array $data, $shopId)
    {
        $customerPreOrderData = array_merge(
            Arr::only($data, ['number', 'reference_number', 'comment']),
            [
                'customer_user_id' => Auth::id(),
                'customer_id' => $shopId
            ]
        );
        $customerPreOrder = $this->repository->create($customerPreOrderData);
        $this->customerPreOrderItemsService->create(Arr::get($data, 'pre_order_items'), $customerPreOrder);
    }

    public function createFromCustomerOrder($shopId, $orderId)
    {
        $customerOrderItems = $this->customerOrderService
            ->with('customerOrderItems')
            ->find($orderId)
            ->customerOrderItems->toArray();
        $customerOrderItems = array_map(function ($customerOrderItem) {
            return [
                'product_id' => $customerOrderItem['product_id'],
                'quantity' => $customerOrderItem['sales_unit_quantity']
            ];
        }, $customerOrderItems);
        $customerPreOrder = $this->repository->create([
            'customer_user_id' => Auth::id(),
            'customer_id' => $shopId
        ]);

        $this->customerPreOrderItemsService->create($customerOrderItems, $customerPreOrder);
    }
}
