<?php

namespace App\Console\Commands\Resources;

use App\CustomerShipment;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\PackageTypeRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\UserRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerShipment resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerShipmentCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_shipment';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_shipment';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var PackageTypeRepository
	 */
	protected $packageTypes;

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
		'packageTypes' => 'name',
		'customers' => 'name',
		'users' => 'name',
	];

	public function __construct(
	    CustomerShipment $customerShipment,
		CustomerShipmentRepository $customerShipmentRepository,
		PackageTypeRepository $packageTypeRepository,
		CustomerRepository $customerRepository,
		UserRepository $userRepository
	)
	{
	    $this->model = $customerShipment;
		$this->repository = $customerShipmentRepository;
		$this->packageTypes = $packageTypeRepository;
		$this->customers = $customerRepository;
		$this->users = $userRepository;

        parent::__construct();
	}

	/**
	 * @param CustomerShipment $customer_shipment
	 * @return array
	 */
	public function getEventAttributes($customer_shipment)
	{
		return $customer_shipment->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
