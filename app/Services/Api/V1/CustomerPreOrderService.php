<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\CustomerPreOrderRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CustomerPreOrderService extends ResourceService
{
    protected $customerPreOrderItemsService;

    public function __construct()
    {
        $this->setRepository(CustomerPreOrderRepositoryEloquent::class);

        $this->customerPreOrderItemsService = app(CustomerPreOrderItemService::class);
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
}