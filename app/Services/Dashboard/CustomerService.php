<?php

namespace App\Services\Dashboard;

use App\Customer;
use App\PriceGroup;
use App\PriceGroupBreakpoint;
use App\ProductGroup;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Eloquent\CustomerRepositoryEloquent;
use App\Services\Api\V1\CustomerPricingPolicyService;
use Crmplease\MaterialAdmin\Services\ResourceService;

class CustomerService extends ResourceService
{
    /**
     * @var CustomerRepositoryEloquent
     */
    protected $repository;

    /**
     * @var CustomerPricingPolicyService
     */
    protected $customerPricingPolicyService;

    /**
     * @param CustomerRepository $customerRepository
     * @param CustomerPricingPolicyService $customerPricingPolicyService
     */
    public function __construct(
        CustomerRepository $customerRepository,
        CustomerPricingPolicyService $customerPricingPolicyService
    )
    {
        $this->repository = $customerRepository;
        $this->customerPricingPolicyService = $customerPricingPolicyService;
    }

    /**
     * @param Customer $customer
     * @param PriceGroup $priceGroup
     */
    public function applyPriceGroupToCustomer(Customer $customer, PriceGroup $priceGroup)
    {
        if ($priceGroup->manual) {
            return;
        }

        /** @var PriceGroupBreakpoint[] $priceGroupBreakpoints * */
        $priceGroupBreakpoints = $priceGroup->priceGroupBreakpoints;
        $this->customerPricingPolicyService->destroyWhere(['customer_id' => $customer->id]);

        foreach ($priceGroupBreakpoints as $priceGroupBreakpoint) {
            /** @var ProductGroup[] $productGroups */
            $productGroups = $priceGroupBreakpoint->productGroups;

            foreach ($productGroups as $productGroup) {
                if ($productGroup->pivot && $productGroup->pivot->price) {
                    $this->customerPricingPolicyService->create([
                        'customer_id' => $customer->id,
                        'products_range' => $priceGroupBreakpoint->breakpoint,
                        'price' => $productGroup->pivot->price,
                        'product_group_id' => $productGroup->id,
                    ]);
                }
            }
        }
    }
}
