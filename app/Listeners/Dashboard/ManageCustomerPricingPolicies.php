<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\PriceGroupBreakpointsAssigned;
use App\PriceGroup;
use App\Services\Dashboard\CustomerService;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesAction;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;

class ManageCustomerPricingPolicies
{
    use ValidatesResource, ValidatesNamespace, ValidatesAction;

    /**
     * @var CustomerService
     */
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * @param PriceGroupBreakpointsAssigned $event
     */
    public function handle(PriceGroupBreakpointsAssigned $event)
    {
        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        if (!$this->isValidNamespace($event->getNamespace())) {
            return;
        }

        if (!$this->isValidAction($event->getAction())) {
            return;
        }

        /** @var PriceGroup $priceGroup */
        $priceGroup = $event->getPriceGroup();

        foreach ($priceGroup->customers as $customer) {
            $this->customerService->applyPriceGroupToCustomer($customer, $priceGroup);
        }
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'price_group_breakpoint',
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

    /**
     * @return array
     */
    protected function getValidActions()
    {
        return [
            'priceGroupBreakpointsAssigned',
        ];
    }
}
