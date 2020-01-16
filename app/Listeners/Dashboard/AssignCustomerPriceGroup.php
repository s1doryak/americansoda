<?php

namespace App\Listeners\Dashboard;

use App\Customer;
use App\PriceGroup;
use App\Services\Dashboard\CustomerService;
use App\Services\Dashboard\PriceGroupService;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceUpdated;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesAction;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;

class AssignCustomerPriceGroup
{
    use ValidatesResource, ValidatesNamespace, ValidatesAction;

    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * @var PriceGroupService
     */
    protected $priceGroupService;

    public function __construct(CustomerService $customerService, PriceGroupService $priceGroupService)
    {
        $this->customerService = $customerService;
        $this->priceGroupService = $priceGroupService;
    }

    /**
     * Handle the event.
     *
     * @param ResourceUpdated $event
     * @return void
     */
    public function handle(ResourceEventInterface $event)
    {
        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        if (!$this->isValidNamespace($event->getNamespace())) {
            return;
        }

        $attributes = $event->getAttributes();

        /** @var Customer $customer */
        $customer = $this->customerService->find($attributes['id']);

        /** @var PriceGroup $priceGroup */
        $priceGroup = $this->priceGroupService->find($attributes['price_group_id']);

        if ($event instanceof ResourceStored) {
            $this->customerService->applyPriceGroupToCustomer($customer, $priceGroup);

            return;
        }

        if ($event instanceof ResourceUpdated) {

            $oldAttributes = $event->getOldAttributes();

            if ($attributes['price_group_id'] !== $oldAttributes['price_group_id']) {
                $this->customerService->applyPriceGroupToCustomer($customer, $priceGroup);
            }

            return;
        }
    }

    protected function getValidResources()
    {
        return [
            'customer',
        ];
    }

    protected function getValidNamespaces()
    {
        return [
            'dashboard',
        ];
    }

    protected function getValidActions()
    {
        return [
            'create',
            'update',
        ];
    }
}
