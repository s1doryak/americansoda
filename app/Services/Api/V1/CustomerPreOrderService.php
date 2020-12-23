<?php

namespace App\Services\Api\V1;

use App\Customer;
use App\CustomerPreOrder;
use App\Notifications\Api\V1\PreOrderCreate;
use App\Repositories\Eloquent\CustomerPreOrderRepositoryEloquent;
use App\Transformers\Api\V1\CustomerPreOrderTransformer;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Exceptions\ValidatorException;

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

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * CustomerPreOrderService constructor.
     * @param CustomerPreOrderRepositoryEloquent $repository
     * @param CustomerPreOrderItemService $customerPreOrderItemService
     * @param CustomerOrderService $customerOrderService
     * @param UserService $userService
     */
    public function __construct(
        CustomerPreOrderRepositoryEloquent $repository,
        CustomerPreOrderItemService $customerPreOrderItemService,
        CustomerOrderService $customerOrderService,
        UserService $userService
    )
    {
        $this->repository = $repository;

        $this->customerPreOrderItemsService = $customerPreOrderItemService;
        $this->customerOrderService = $customerOrderService;
        $this->userService = $userService;
    }

    /**
     * @param array $data
     * @param $shopId
     * @throws ValidatorException
     */
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

        $attributes = ['id' => $customerPreOrder->id];
        event(new ResourceStored('api', 'customer_pre_order', 'store', $attributes, []));

        /** @var Collection $users */
        $users = $this->userService->notifiable();
        $users->each(function ($user) use ($shopId, $customerPreOrder) {
            $customer = Customer::find($shopId);
            $user->notify(new PreOrderCreate($customer, $customerPreOrder));
        });
    }

    /**
     * @param $shopId
     * @param bool $withoutOrders
     * @return mixed
     */
    public function getByShopId($shopId, $withoutOrders = false)
    {
        /** @var \Illuminate\Support\Collection|CustomerPreOrder[] $customerPreOrders */
        $customerPreOrders = $this->repository->getByShopId($shopId, $withoutOrders);

        return $customerPreOrders
            ->map(function ($customerOrder) {
                return CustomerPreOrderTransformer::toArray($customerOrder);
            });
    }
}
