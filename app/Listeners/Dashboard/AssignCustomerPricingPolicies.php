<?php

namespace App\Listeners\Dashboard;

use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceUpdated;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use App\Repositories\Contracts\CustomerPricingPolicyRepository;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Arr;

class AssignCustomerPricingPolicies
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var CustomerPricingPolicyRepository
     */
    protected $customerPricingPolicies;

    /**
     * Create the event listener.
     *
     * @param CustomerPricingPolicyRepository $customerPricingPolicies
     */
    public function __construct(
        CustomerPricingPolicyRepository $customerPricingPolicyRepository
    )
    {
        $this->customerPricingPolicies = $customerPricingPolicyRepository;
    }

    /**
     * Handle the event.
     *
     * @param ResourceEventInterface $event
     * @return void
     */
    public function handle(ResourceEventInterface $event)
    {
        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        $attributes = $event->getAttributes();
        $params = $event->getParams();

        $updated = [];

        $policies = Arr::get($params, 'customerPricingPolicies', []);

        foreach ($policies as $policy) {

            $_changed = Arr::pull($policy, '_changed');

            if (booleanize($policy['_remove'] ?? false)) {

                $deleted = $this->customerPricingPolicies->findWhere(['id' => $policy['id']]);

                if ($deleted) {

                    $this->customerPricingPolicies->trash($policy['id']);

                    $updated[] = array_merge($policy, $deleted->toArray(), compact('_changed'));
                }

                continue;
            }

            $_policy = [
                'customer_id' => $attributes['id'],
                'product_group_id' => $policy['productGroup'],
                'products_range' => $policy['products_range'],
                'price' => $policy['price'],
            ];

            if ($event instanceof ResourceStored) {
                $policy['customer_id'] = $attributes['id'];

                $saved = $this->customerPricingPolicies->create($_policy);
            } else {
                $id = Arr::pull($policy, 'id');
                $saved = $this->customerPricingPolicies->updateOrCreate(compact('id'), $_policy);
            }

            $updated[] = array_merge($_policy, $saved->toArray(), compact('_changed'));
        }

        event(
            new ResourceUpdated(
                'dashboard',
                'customer.pricing_policy',
                'update',
                $updated,
                $params
            )
        );
    }

    protected function getValidResources()
    {
        return [
            'customer'
        ];
    }
}
