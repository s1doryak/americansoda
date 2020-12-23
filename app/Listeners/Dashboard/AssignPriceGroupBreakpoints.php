<?php

namespace App\Listeners\Dashboard;

use App\PriceGroup;
use App\PriceGroupBreakpoint;
use App\Repositories\Contracts\CustomerPricingPolicyRepository;
use App\Repositories\Contracts\PriceGroupBreakpointRepository;
use App\Repositories\Contracts\PriceGroupRepository;
use App\Repositories\Eloquent\CustomerPricingPolicyRepositoryEloquent;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesAction;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * AssignPriceGroupBreakpoints listener.
 *
 * @package App\Listeners\Dashboard
 */
class AssignPriceGroupBreakpoints
{
    use ValidatesAction, ValidatesResource, ValidatesNamespace;

    /**
     * @var PriceGroupRepository
     */
    protected $priceGroups;

    /**
     * @var PriceGroupBreakpointRepository
     */
    protected $priceGroupBreakpoints;

    /**
     * @var CustomerPricingPolicyRepositoryEloquent
     */
    protected $customerPricingPolicies;

    /**
     * AssignPriceGroupBreakpoints constructor.
     * @param PriceGroupRepository $priceGroupRepository
     * @param PriceGroupBreakpointRepository $priceGroupBreakpointRepository
     * @param CustomerPricingPolicyRepository $customerPricingPolicyRepository
     */
    public function __construct(
        PriceGroupRepository $priceGroupRepository,
        PriceGroupBreakpointRepository $priceGroupBreakpointRepository,
        CustomerPricingPolicyRepository $customerPricingPolicyRepository
    )
    {
        $this->priceGroups = $priceGroupRepository;
        $this->priceGroupBreakpoints = $priceGroupBreakpointRepository;
        $this->customerPricingPolicies = $customerPricingPolicyRepository;
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

        if (!$this->isValidAction($e->getAction())) {
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
        )
            ->with([
                'priceGroupBreakpoints',
                'customers'
            ])
            ->find($attributes['id']);

        if ($priceGroup->manual) {
            $this->priceGroupBreakpoints->destroyWhere(['price_group_id' => $priceGroup->getKey()]);
        } else {
            $items = Arr::get($params, 'priceGroupBreakpoints', []);
            $policies = [];

            foreach ($items as $idx => $item) {
                $id = numerize($item['id'] ?? false);
                $removing = booleanize($item['_remove'] ?? false);

                if ($removing && $id) {
                    $this->priceGroupBreakpoints->destroy($id);
                    continue;
                }

                $breakpoint = (integer)Arr::get($item, 'breakpoint', 0);
                $productGroups = (array)$item['productGroups'] ?? [];
                $data = compact('breakpoint');

                if ($id) {
                    /** @var PriceGroupBreakpoint $priceGroupBreakpoint */
                    $priceGroupBreakpoint = $this->priceGroupBreakpoints->update($data, $id);
                } else {
                    /** @var PriceGroupBreakpoint $priceGroupBreakpoint */
                    $priceGroupBreakpoint = $this->priceGroupBreakpoints->create($data);
                }

                $priceGroupBreakpoint->priceGroup()->associate($priceGroup);
                $priceGroupBreakpoint->productGroups()->sync($productGroups);
                $priceGroupBreakpoint->save();

                $policies = array_merge($policies, $this->preparePolicies($productGroups, $breakpoint));
            }

            $this->updateCustomerPricingPolicies($priceGroup, $policies);
        }
    }

    /**
     * @param array $productGroups
     * @param int $priceGroupBreakpoint
     * @return array
     */
    protected function preparePolicies(array $productGroups, int $priceGroupBreakpoint)
    {
        $policies = [];
        $productGroups = array_filter(
            $productGroups,
            function (array $productGroup) {
                return $productGroup['price'] ?? false;
            }
        );

        foreach ($productGroups as $productGroup => $productGroupValues) {
            $policies[] = [
                'productsRange' => $priceGroupBreakpoint,
                'productGroup' => $productGroup,
                'price' => $productGroupValues['price'],
            ];
        }

        return $policies;
    }

    protected function updateCustomerPricingPolicies(PriceGroup $priceGroup, array $policies)
    {
        $ids = $priceGroup->customers->pluck('id');
        $this->customerPricingPolicies->trashWhereIn('customer_id', $ids->toArray());

        foreach ($ids as $customer) {
            $this->insertCustomerPricingPolicies($policies, $customer);
        }
    }

    protected function insertCustomerPricingPolicies(array $policies, $customer)
    {
        $sql = 'Insert into customer_pricing_policies (customer_id, products_range, price, product_group_id, created_at, updated_at) values';
        $policies = $this->transformPolicies($policies, $customer);
        $values = implode(',', $policies);
        $insert = "{$sql} {$values};";

        DB::transaction(function () use ($insert){
            DB::unprepared($insert);
        });
    }

    /**
     * @param array $policies
     * @param $customer
     * @return array
     */
    protected function transformPolicies(array $policies, $customer)
    {
        $now = Carbon::now();
        $policies = array_map(function ($policy) use ($customer, $now) {
            return "({$customer}, {$policy['productsRange']}, {$policy['price']}, {$policy['productGroup']}, '{$now}', '{$now}')";
        }, $policies);

        return $policies;
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

    /**
     * @return array
     */
    protected function getValidActions()
    {
        return [
            'store',
            'update',
        ];
    }
}
