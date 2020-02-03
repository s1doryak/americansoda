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
    /**
     * @var string
     */
    protected $name = 'resource:create:price_group_breakpoint';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'price_group_breakpoint';

    /**
     * @var string
     */
    protected $action = 'store';

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
        $this->model = $priceGroupBreakpoint;
        $this->repository = $priceGroupBreakpointRepository;
        $this->priceGroups = $priceGroupRepository;
        $this->productGroups = $productGroupRepository;

        parent::__construct();
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
