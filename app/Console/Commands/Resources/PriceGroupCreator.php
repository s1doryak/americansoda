<?php

namespace App\Console\Commands\Resources;

use App\PriceGroup;
use App\Repositories\Contracts\PriceGroupRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * PriceGroup resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class PriceGroupCreator extends ResourceCreator
{
    protected $name = 'resource:create:price_group';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    PriceGroup $priceGroup,
		PriceGroupRepository $priceGroupRepository
	)
	{
	    $this->resource = $priceGroup;
		$this->repository = $priceGroupRepository;

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
		return 'price_group';
	}

	/**
	 * @param PriceGroup $priceGroup
	 * @return array
	 */
	public function getEventAttributes($priceGroup)
	{
		return $priceGroup->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
