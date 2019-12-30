<?php

namespace App\Console\Commands\Resources;

use App\CustomerType;
use App\Repositories\Contracts\CustomerTypeRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerType resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerTypeCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_type';

	/**
	 * @var CustomerTypeRepository
	 */
	protected $customerTypes;


	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'customerTypes' => 'name',
	];

	public function __construct(
	    CustomerType $customerType,
		CustomerTypeRepository $customerTypeRepository
	)
	{
	    $this->resource = $customerType;
		$this->repository = $customerTypeRepository;
		$this->customerTypes = $customerTypeRepository;

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
		return 'customer_type';
	}

    /**
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
    }

	/**
	 * @param CustomerType $customer_type
	 * @return array
	 */
	public function getEventAttributes($customer_type)
	{
		return $customer_type->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
