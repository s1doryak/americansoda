<?php

namespace App\Listeners\Dashboard;

use App\PriceGroup;
use App\PriceGroupBreakpoint;
use App\Events\Dashboard\PriceGroupBreakpointsAssigned;
use App\Repositories\Contracts\PriceGroupBreakpointRepository;
use App\Repositories\Contracts\PriceGroupRepository;
use Crmplease\MaterialAdmin\Events\ResourceDestroyed;
use Crmplease\MaterialAdmin\Events\ResourceRestored;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceTrashed;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * AssignPriceGroupBreakpoints listener.
 *
 * @package App\Listeners\Dashboard
 */
class AssignPriceGroupBreakpoints
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var PriceGroupRepository
     */
    protected $priceGroups;

    /**
     * @var PriceGroupBreakpointRepository
     */
    protected $priceGroupBreakpoints;

    /**
     * AssignPriceGroupBreakpoints constructor.
     * @param PriceGroupRepository $priceGroupRepository
     * @param PriceGroupBreakpointRepository $priceGroupBreakpointRepository
     */
    public function __construct(
        PriceGroupRepository $priceGroupRepository,
        PriceGroupBreakpointRepository $priceGroupBreakpointRepository
    )
    {
        $this->priceGroups = $priceGroupRepository;
        $this->priceGroupBreakpoints = $priceGroupBreakpointRepository;
    }

    /**
     * @param ResourceEventInterface $e
     * @return void
     */
    public function handle(ResourceEventInterface $e)
    {
        if (!$this->isValidNamespace($e->getNamespace())) {
            return;
        }

        if (!$this->isValidResource($e->getResource())) {
            return;
        }

        $attributes = $e->getAttributes();
        $params = $e->getParams();

        /** @var PriceGroup $priceGroup */
        $priceGroup = $this->priceGroups->scopeQuery(
            function ($query) {
                /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                return $query->withTrashed();
            }
        )->find($attributes['id']);

        if ($e instanceof ResourceTrashed) {

            // ...
        }

        if ($e instanceof ResourceDestroyed) {

            // ...
        }

        if ($e instanceof ResourceRestored) {

            // ...
        }

        if ($e instanceof ResourceStored) {

            // ...
        }

        $items = Arr::get($params, 'priceGroupBreakpoints', []);

        $priceGroupBreakpoints = new Collection();

        foreach ($items as $idx => $item) {

            $id = $item['id'] ?? false;
            $removing = $item['_remove'] ?? false;

            if ($removing) {

                if ($id) {
                    $this->priceGroupBreakpoints->destroy($id);
                }

                continue;
            }

            $breakpoint = (integer)$item['breakpoint'] ?? 0;
            $productGroups = (array)$item['productGroups'] ?? [];

            $data = [
                'breakpoint' => $breakpoint
            ];

            if ($id) {
                /** @var PriceGroupBreakpoint $priceGroupBreakpoint */
                $priceGroupBreakpoint = $this->priceGroupBreakpoints->update($data, $id);
            } else {
                /** @var PriceGroupBreakpoint $priceGroupBreakpoint */
                $priceGroupBreakpoint = $this->priceGroupBreakpoints->create($data);
            }

            $priceGroupBreakpoint->productGroups()->sync($productGroups);

            $priceGroupBreakpoints->push($priceGroupBreakpoint);
        }

        event(new PriceGroupBreakpointsAssigned($priceGroup, $priceGroupBreakpoints, $attributes, $params));

        return;
    }

    /**
     * @return array
     */
    protected function getValidNamespaces()
    {
        return [
            'dashboard',
        ];
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'price_group',
        ];
    }
}
