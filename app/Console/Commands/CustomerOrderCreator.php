<?php

namespace App\Console\Commands;

use App\CustomerOrder;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\UserRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerOrder resource creator.
 *
 * @package App\Console\Commands
 */
class CustomerOrderCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_order';

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
	    $this->resource = $customerOrder;
		$this->repository = $customerOrderRepository;
		$this->customers = $customerRepository;
		$this->users = $userRepository;

        parent::__construct();
	}

	/**
	 * @return string
	 */
	public function getEventNamespace()
	{
		return 'cli';
	}

	/**
	 * @return string
	 */
	public function getEventResource()
	{
		return 'customer_order';
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