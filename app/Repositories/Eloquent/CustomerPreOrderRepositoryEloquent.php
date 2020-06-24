<?php

namespace App\Repositories\Eloquent;

use App\CustomerPreOrder;
use App\Repositories\Contracts\CustomerPreOrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerPreOrderRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerPreOrderRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerPreOrder::class;
    }

    public function getByShopId($shopId, $withoutOrders = false)
    {
        $where = ['customer_id' => $shopId];

        if ($withoutOrders) {
            $where['customer_order_id'] = null;
        }

        return $this
            ->orderBy(DB::raw('SOUNDEX(number), LENGTH(number), number'), 'desc')
            ->findWhere($where);
    }

    /**
     * @param null $date
     * @param array $exclude
     * @return string
     */
    public function getFirstAvailableNumber($date = null, array $exclude = [])
    {
        if (is_null($date)) {
            $date = date('Ymd');
        } else {
            if (preg_match('/^PREORDER-[0-9]{8}/', $date)) {
                $date = substr($date, 9, 8);
            }
        }

        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
        $query = $this->model->select();

        $query->whereRaw(sprintf("`number` REGEXP 'PREORDER-%s.*'", $date));

        if (count($exclude)) {
            $query->whereNotIn('id', $exclude);
        }

        /** @var \Illuminate\Support\Collection $preOrders */
        $preOrders = $query->get();

        /** @var \Illuminate\Support\Collection $numbers */
        $numbers = $preOrders->pluck('number')->map(
            function ($number) use ($date) {
                return Str::replaceFirst(sprintf('PREORDER-%s-', $date), '', $number);
            }
        )->unique()->sort();

        $last = $numbers->last();

        return sprintf('PREORDER-%s-%s', $date, $last + 1);
    }
}
