<?php

namespace App\Console\Commands\Resources;

use App\CustomerUser;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerUser resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerUserCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_user';


	/**
	 * @var CustomerRepository
	 */
	protected $customers;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'customers' => 'name',
	];

	public function __construct(
	    CustomerUser $customerUser,
		CustomerUserRepository $customerUserRepository,
		CustomerRepository $customerRepository
	)
	{
	    $this->resource = $customerUser;
		$this->repository = $customerUserRepository;
		$this->customers = $customerRepository;

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
		return 'customer_user';
	}

	/**
	 * @param CustomerUser $customerUser
	 * @return array
	 */
	public function getEventAttributes($customerUser)
	{
		return $customerUser->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
