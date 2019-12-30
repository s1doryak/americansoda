<?php

namespace App\Console\Commands\Resources;

use App\PriceGroupBreakpoint;
use App\Repositories\Contracts\PriceGroupBreakpointRepository;
use App\Repositories\Contracts\PriceGroupRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * PriceGroupBreakpoint resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class PriceGroupBreakpointCreator extends ResourceCreator
{
    protected $name = 'resource:create:price_group_breakpoint';


	/**
	 * @var PriceGroupRepository
	 */
	protected $priceGroups;

	/**
	 * @var ProductGroupRepository
	 */
	protected $productGroups;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'priceGroups' => 'name',
		'productGroups' => 'name',
	];

	public function __construct(
	    PriceGroupBreakpoint $priceGroupBreakpoint,
		PriceGroupBreakpointRepository $priceGroupBreakpointRepository,
		PriceGroupRepository $priceGroupRepository,
		ProductGroupRepository $productGroupRepository
	)
	{
	    $this->resource = $priceGroupBreakpoint;
		$this->repository = $priceGroupBreakpointRepository;
		$this->priceGroups = $priceGroupRepository;
		$this->productGroups = $productGroupRepository;

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
		return 'price_group_breakpoint';
	}

    /**
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
    }

	/**
	 * @param PriceGroupBreakpoint $priceGroupBreakpoint
	 * @return array
	 */
	public function getEventAttributes($priceGroupBreakpoint)
	{
		return $priceGroupBreakpoint->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
