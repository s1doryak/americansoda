<?php

namespace App\Console\Commands\Resources;

use App\CustomerPreOrder;
use App\Repositories\Contracts\CustomerPreOrderRepository;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerPreOrder resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerPreOrderCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_pre_order';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_pre_order';

    /**
     * @var string
     */
    protected $action = 'store';

    /**
     * @var CustomerUserRepository
     */
    protected $customerUsers;

    /**
     * @var CustomerOrderRepository
     */
    protected $customerOrders;

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var array
     */
    protected $findOrCreateData = [
        'customerUsers' => 'name',
        'customerOrders' => 'number',
        'customers' => 'name',
    ];

    public function __construct(
        CustomerPreOrder $customerPreOrder,
        CustomerPreOrderRepository $customerPreOrderRepository,
        CustomerUserRepository $customerUserRepository,
        CustomerOrderRepository $customerOrderRepository,
        CustomerRepository $customerRepository
    )
    {
        $this->model = $customerPreOrder;
        $this->repository = $customerPreOrderRepository;
        $this->customerUsers = $customerUserRepository;
        $this->customerOrders = $customerOrderRepository;
        $this->customers = $customerRepository;

        parent::__construct();
    }

    /**
     * @param CustomerPreOrder $customerPreOrder
     * @return array
     */
    public function getEventAttributes($customerPreOrder)
    {
        return $customerPreOrder->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
