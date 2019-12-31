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
    /**
     * @var string
     */
    protected $name = 'resource:create:price_group';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'price_group';

    /**
     * @var string
     */
    protected $action = 'store';

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
	    $this->model = $priceGroup;
		$this->repository = $priceGroupRepository;

        parent::__construct();
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
