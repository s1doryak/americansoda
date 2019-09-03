<?php

namespace App\Listeners\Dashboard;

use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use App\Repositories\Contracts\CustomerPricingPolicyRevisionRepository;
use App\Repositories\Contracts\CustomerRepository;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Contracts\Auth\Guard;

class CreateCustomerPricingPolicyRevision
{
	use ValidatesResource;

	/**
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Pricing policy revisions.
	 *
	 * @var CustomerPricingPolicyRevisionRepository
	 */
	protected $revisions;

	protected $customers;

	public function __construct(
		Guard $auth,
		CustomerPricingPolicyRevisionRepository $revisions,
		CustomerRepository $customerRepository
	)
	{
		$this->auth = $auth;
		$this->revisions = $revisions;
		$this->customers = $customerRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param  ResourceEventInterface $event
	 * @return void
	 */
	public function handle(ResourceEventInterface $event)
	{
		if (!$this->isValidResource($event->getResource())) {
			return;
		}

		$policies = array_filter($event->getAttributes(), function ($policy) {
			$_changed = isset($policy['_changed']) && (boolean)$policy['_changed'] === true;
			$_remove = isset($policy['_remove']) && (boolean)$policy['_remove'] === true;

			return $_changed || $_remove;
		});

		foreach ($policies as $policy) {

			unset($policy['_changed']);

			if (!empty($policy['_remove'])) {
				$policy['trashed'] = true;
				$policy['deleted_at'] = Carbon::now();
			}

			unset($policy['_remove']);

			try {
				$editorId = $this->auth->user() ? $this->auth->user()->getAuthIdentifier() : $this->customers->makeModel()->with('user')->withTrashed()->find($policy['customer_id'])->user->getKey();
				$this->revisions->addRevision($policy, $editorId);
			} catch (\Exception $e) {

			}
		}
	}

	/**
	 * @return array
	 */
	protected function getValidResources()
	{
		return [
			'customer.pricing_policy',
			'customer_pricing_policy'
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
