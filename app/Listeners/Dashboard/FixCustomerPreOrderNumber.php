<?php

namespace App\Listeners\Dashboard;

use App\Repositories\Eloquent\CustomerPreOrderRepositoryEloquent;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;

class FixCustomerPreOrderNumber
{
    use ValidatesResource;

    /**
     * @var CustomerPreOrderRepositoryEloquent
     */
    protected $customerPreOrderRepository;

    public function __construct(
        CustomerPreOrderRepositoryEloquent $customerPreOrderRepository
    )
    {
        $this->customerPreOrderRepository = $customerPreOrderRepository;
    }

    public function handle(ResourceEventInterface $event)
    {
        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        $attributes = $event->getAttributes();

        $preOrder = $this->customerPreOrderRepository->scopeQuery(
            function ($query) {
                /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\SoftDeletes $query */
                return $query->withTrashed();
            }
        )->find($attributes['id']);

        if ($preOrder->trashed()) {
            return;
        }

        $this->customerPreOrderRepository->update([
            'number' => $this->customerPreOrderRepository->getFirstAvailableNumber($preOrder->number, [$preOrder->id])
        ], $attributes['id']);
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

    /**
     * @return array
     */
    protected function getValidNamespaces()
    {
        return [
            'dashboard',
        ];
    }
}