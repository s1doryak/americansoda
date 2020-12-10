<?php

namespace App\Repositories\Eloquent;

use App\CustomerOrder;
use App\Repositories\Contracts\CustomerOrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerOrderRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerOrderRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerOrder::class;
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
            if (preg_match('/^SODA-[0-9]{8}/', $date)) {
                $date = substr($date, 5, 8);
            }
        }

        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
        $query = $this->model->select();

        $query->whereRaw(sprintf("`number` REGEXP 'SODA-%s.*'", $date));

        if (count($exclude)) {
            $query->whereNotIn('id', $exclude);
        }

        /** @var \Illuminate\Support\Collection $orders */
        $orders = $query->get();

        /** @var \Illuminate\Support\Collection $numbers */
        $numbers = $orders->pluck('number')->map(
            function ($number) use ($date) {
                return Str::replaceFirst(sprintf('SODA-%s-', $date), '', $number);
            }
        )->unique()->sort();

        $last = $numbers->last();

        return sprintf('SODA-%s-%s', $date, $last + 1);
    }

    /**
     * @param null $start
     * @param null $end
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getValidOrders($start = null, $end = null)
    {
        $this->applyCriteria();
        $this->applyScope();

        $column = 'number';

        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
        $query = $this->model->select('customer_orders.*');

        $query->whereRaw(DB::raw(sprintf("`%s` regexp 'SODA-[0-9]{8}.*'", $column)));

        $format = 'Y-m-d';
        $column = 'number';

        if (is_date($start, $format)) {
            $query->whereRaw(
                DB::raw(sprintf("STR_TO_DATE(SUBSTRING(%s, 6, 8), '%s') >= '%s'", $column, '%Y%m%d', carbon($start, $format)->startOfDay()))
            );
        }

        if (is_date($end, $format)) {
            $query->whereRaw(
                DB::raw(sprintf("STR_TO_DATE(SUBSTRING(%s, 6, 8), '%s') <= '%s'", $column, '%Y%m%d', carbon($end, $format)->endOfDay()))
            );
        }

        $this->resetModel();

        return $this->parserResult($query->get());
    }

    /**
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getLastOrders()
    {
        $this->applyCriteria();
        $this->applyScope();

        $column = 'number';
        $format = '%Y%m%d';
        $interval = 'customers.order_interval';

        /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
        $query = $this->model
            ->select('customer_orders.*')
            ->addSelect(
                [
                    DB::raw(sprintf("str_to_date(substring(number, 6, 8), '%s') as date", $format)),
                    DB::raw(
                        sprintf(
                            "date_add(str_to_date(substring(number, 6, 8), '%s'), interval %s day) AS future_date",
                            $format,
                            $interval
                        )
                    ),
                ]
            )
            ->join('customers', 'customer_orders.customer_id', '=', 'customers.id')
            ->whereIn('number', function ($query) use ($column) {
                /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                $query->select(
                    DB::raw(sprintf('max(%s)', $column))
                )
                    ->from(
                        DB::raw('customer_orders AS co')
                    )
                    ->join(DB::raw('customers AS c'), 'co.customer_id', '=', 'c.id')
                    ->whereRaw(
                        DB::raw('co.customer_id = customer_orders.customer_id')
                    )
                    ->whereRaw(
                        DB::raw(sprintf("`%s` regexp 'SODA-[0-9]{8}.*'", $column))
                    )
                    ->where([
                        ['customers.order_interval', '>', 0]
                    ]);
            });

        $this->resetModel();

        return $this->parserResult($query->get());
    }

    public function getByShopId($shopId)
    {
        return $this->model
            ->select('customer_orders.*')
            ->where('customer_id', $shopId)
            ->orderByRaw(DB::raw('SOUNDEX(number) desc, LENGTH(number) desc, number desc'))
            ->get();
    }
}
