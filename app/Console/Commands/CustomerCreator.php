<?php

namespace App\Console\Commands;

use App\Customer;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\CustomerTypeRepository;
use App\Repositories\Contracts\PaymentTypeRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\RegionRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;
use App\Repositories\Contracts\PriceGroupRepository;

/**
 * Customer resource creator.
 *
 * @package App\Console\Commands
 */
class CustomerCreator extends ResourceCreator
{
	
	/**
	 * @var PriceGroupRepository
	 */
	protected $priceGroups;
    protected $name = 'resource:create:customer';

	/**
	 * @var StockRepository
	 */
	protected $stocks;
	
	/**
	 * @var CustomerTypeRepository
	 */
	protected $customerTypes;
	
	/**
	 * @var PaymentTypeRepository
	 */
	protected $paymentTypes;
	
	/**
	 * @var UserRepository
	 */
	protected $users;
	
	/**
	 * @var RegionRepository
	 */
	protected $billingRegions;
	
	/**
	 * @var RegionRepository
	 */
	protected $shippingRegions;
	

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'stocks' => 'name',
		'customerTypes' => 'name',
		'paymentTypes' => 'name',
		'users' => 'name',
		'billingRegions' => 'name',
		'shippingRegions' => 'name',
				'priceGroups' => 'name',

	];

	public function __construct(
	    Customer $customer,
		CustomerRepository $customerRepository,
		StockRepository $stockRepository,
		CustomerTypeRepository $customerTypeRepository,
		PaymentTypeRepository $paymentTypeRepository,
		UserRepository $userRepository,
		RegionRepository $regionRepository,
		PriceGroupRepository $priceGroupRepository
	)
	{
	    $this->priceGroups = $priceGroupRepository;
		$this->resource = $customer;
		$this->repository = $customerRepository;
		$this->stocks = $stockRepository;
		$this->customerTypes = $customerTypeRepository;
		$this->paymentTypes = $paymentTypeRepository;
		$this->users = $userRepository;
		$this->billingRegions = $regionRepository;
		$this->shippingRegions = $regionRepository;

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
		return 'customer';
	}

	/**
	 * @param Customer $customer
	 * @return array
	 */
	public function getEventAttributes($customer)
	{
		return $customer->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}