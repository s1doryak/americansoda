<?php

namespace App\Listeners\Dashboard;

use App\Customer;
use App\Repositories\Contracts\CustomerRepository;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;

class FixCustomerNumber
{
    use ValidatesResource;

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * FixCustomerNumber constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        CustomerRepository $customerRepository
    )
    {
        $this->customers = $customerRepository;
    }

    /**
     * Handle the event.
     *
     * @param ResourceEventInterface $event
     *
     * @return void
     */
    public function handle(ResourceEventInterface $event)
    {

        if (!$this->isValidResource($event->getResource())) {
            return;
        }

        $attributes = $event->getAttributes();

        /** @var Customer $customer */
        $customer = $this->customers->scopeQuery(
            function ($query) {
                /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\SoftDeletes $query */
                return $query->withTrashed();
            }
        )->find($attributes['id']);

        if ($customer->trashed()) {
            return;
        }

        $this->customers->update([
            'nr' => $this->customers->getFirstAvailableNumber([$customer->id])
        ], $attributes['id']);
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'customer',
            'customer',
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
