<?php

namespace App\Console\Commands\Resources;

use App\CustomerOrder;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\UserRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerOrder resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerOrderCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_order';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_order';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var CustomerRepository
	 */
	protected $customers;

	/**
	 * @var UserRepository
	 */
	protected $users;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'customers' => 'name',
		'users' => 'name',
	];

	public function __construct(
	    CustomerOrder $customerOrder,
		CustomerOrderRepository $customerOrderRepository,
		CustomerRepository $customerRepository,
		UserRepository $userRepository
	)
	{
	    $this->model = $customerOrder;
		$this->repository = $customerOrderRepository;
		$this->customers = $customerRepository;
		$this->users = $userRepository;

        parent::__construct();
	}

	/**
	 * @param CustomerOrder $customer_order
	 * @return array
	 */
	public function getEventAttributes($customer_order)
	{
		return $customer_order->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
