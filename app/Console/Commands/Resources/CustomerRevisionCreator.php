<?php

namespace App\Console\Commands\Resources;

use App\CustomerRevision;
use App\Repositories\Contracts\CustomerRevisionRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\CustomerTypeRepository;
use App\Repositories\Contracts\PaymentTypeRepository;
use App\Repositories\Contracts\RegionRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;
use App\Repositories\Contracts\PriceGroupRepository;

/**
 * CustomerRevision resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerRevisionCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_revision';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_revision';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var CustomerRevisionRepository
	 */
	protected $revisions;

	/**
	 * @var UserRepository
	 */
	protected $editors;

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
     * @var PriceGroupRepository
     */
    protected $priceGroups;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'revisions' => 'name',
		'editors' => 'name',
		'stocks' => 'name',
		'customerTypes' => 'name',
		'paymentTypes' => 'name',
		'users' => 'name',
		'billingRegions' => 'name',
		'shippingRegions' => 'name',
		'priceGroups' => 'name',
	];

	public function __construct(
	    CustomerRevision $customerRevision,
		CustomerRevisionRepository $customerRevisionRepository,
		UserRepository $userRepository,
		StockRepository $stockRepository,
		CustomerTypeRepository $customerTypeRepository,
		PaymentTypeRepository $paymentTypeRepository,
		RegionRepository $regionRepository,
		PriceGroupRepository $priceGroupRepository
	)
	{
		$this->model = $customerRevision;
		$this->repository = $customerRevisionRepository;
		$this->revisions = $customerRevisionRepository;
		$this->editors = $userRepository;
		$this->stocks = $stockRepository;
		$this->customerTypes = $customerTypeRepository;
		$this->paymentTypes = $paymentTypeRepository;
		$this->users = $userRepository;
		$this->billingRegions = $regionRepository;
		$this->shippingRegions = $regionRepository;
        $this->priceGroups = $priceGroupRepository;

        parent::__construct();
	}

	/**
	 * @param CustomerRevision $customer_revision
	 * @return array
	 */
	public function getEventAttributes($customer_revision)
	{
		return $customer_revision->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
