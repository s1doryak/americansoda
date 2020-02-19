<?php

namespace App\Listeners\Dashboard;

use App\CustomerPreOrder;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerPreOrderRepository;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Facades\Auth;

class MatchPreOrderWithOrder
{
    use ValidatesResource;

    /**
     * @var CustomerPreOrderRepository $customerPreOrders
     */
    protected $customerPreOrders;

    /**
     * @var CustomerOrderRepository $customerOrders
     */
    protected $customerOrders;

    public function __construct(
        CustomerPreOrderRepository $customerPreOrderRepository,
        CustomerOrderRepository $customerOrderRepository
    )
    {
        $this->customerOrders = $customerOrderRepository;
        $this->customerPreOrders = $customerPreOrderRepository;
    }

    /**
     * Handle the event.
     *
     * @param ResourceEventInterface $event
     */
    public function handle(ResourceEventInterface $event)
    {
        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        $attributes = $event->getAttributes();
        $params = $event->getParams();

        /**
         * @var CustomerPreOrder $customerPreOrder
         */
        $customerPreOrder = $this->customerPreOrders->with(['customerOrder', 'items'])->firstWhere(['id' => $attributes['id']]);

        if (!$customerPreOrder->customerOrder) {
            $customerOrder = $this->customerOrders->create([
                'number' => $this->customerOrders->getFirstAvailableNumber(),
                'batch_number' => $attributes['reference_number'],
                'comment' => $attributes['comment'],
                'user_id' => Auth::id(),
                'customer_id' => $attributes['customer_id'],
            ]);
            $items = $customerPreOrder->items->map(function ($item) {
                $item->product = $item->product_id;
                $item->product_price = $item->price;
                $item->sales_unit_quantity = $item->quantity;

                return $item;
            });

            event(new ResourceStored(
                    'dashboard',
                    'customer_order',
                    'store',
                    [
                        'id' => $customerOrder->getKey(),
                        'customer_id' => $attributes['customer_id']
                    ],
                    [
                        'customerOrderItems' => $items->toArray()
                    ]
                )
            );
        }
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'customer_pre_order',
        ];
    }
}