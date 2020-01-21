<?php

namespace App\Services\Api\V1;

use App\Customer;
use App\Notifications\Api\V1\PreOrderCreate;
use App\Repositories\Eloquent\CustomerPreOrderRepositoryEloquent;
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
     * @var AdministratorService
     */
    protected $administratorService;

    /**
     * CustomerPreOrderService constructor.
     * @param CustomerPreOrderRepositoryEloquent $repository
     * @param CustomerPreOrderItemService $customerPreOrderItemService
     * @param CustomerOrderService $customerOrderService
     * @param AdministratorService $administratorService
     */
    public function __construct(
        CustomerPreOrderRepositoryEloquent $repository,
        CustomerPreOrderItemService $customerPreOrderItemService,
        CustomerOrderService $customerOrderService,
        AdministratorService $administratorService
    )
    {
        $this->repository = $repository;

        $this->customerPreOrderItemsService = $customerPreOrderItemService;
        $this->customerOrderService = $customerOrderService;
        $this->administratorService = $administratorService;
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

        /** @var Collection $administrators */
        $administrators = $this->administratorService->all();
        $administrators->each(function ($administrator) use ($shopId, $customerPreOrder) {
            $customer = Customer::find($shopId);
            $administrator->notify(new PreOrderCreate($customer, $customerPreOrder));
        });
    }

    /**
     * @param integer $shopId
     * @param integer $orderId
     * @throws ValidatorException
     */
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
