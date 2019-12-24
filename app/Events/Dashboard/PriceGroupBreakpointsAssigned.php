<?php

namespace App\Events\Dashboard;

use App\PriceGroup;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Illuminate\Support\Collection;

class PriceGroupBreakpointsAssigned implements ResourceEventInterface
{
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var PriceGroup
     */
    private $priceGroup;

    /**
     * @var Collection
     */
    private $priceGroupBreakpoints;

    /**
     * PriceGroupBreakpointsAssigned constructor.
     * @param PriceGroup $priceGroup
     * @param Collection $priceGroupBreakpoints
     * @param array $attributes
     * @param array $params
     */
    public function __construct(PriceGroup $priceGroup, Collection $priceGroupBreakpoints, array $attributes, array $params)
    {
        $this->priceGroup = $priceGroup;
        $this->priceGroupBreakpoints = $priceGroupBreakpoints;
        $this->attributes = $attributes;
        $this->params = $params;
    }

    /**
     * @return PriceGroup
     */
    public function getPriceGroup()
    {
        return $this->priceGroup;
    }

    /**
     * @return Collection
     */
    public function getPriceGroupBreakpoints()
    {
        return $this->priceGroupBreakpoints;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return 'dashboard';
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return 'price_group_breakpoint';
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
