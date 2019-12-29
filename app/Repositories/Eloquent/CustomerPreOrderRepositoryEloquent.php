<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerPreOrderRepository;
use DB;
use Illuminate\Support\Str;

class CustomerPreOrderRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerPreOrderRepository
{
    public function getByShopId($shopId)
    {
        return $this
            ->orderBy(DB::raw('number', 'SOUNDEX(number) $1, LENGTH(number) $1, number $1'))
            ->findWhere(['customer_id' => $shopId]);
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
