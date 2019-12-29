<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerPricingPolicyRepository;

class CustomerPricingPolicyRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerPricingPolicyRepository
{
    /**
     * @param $customerId
     * @param array $policies
     * @return array
     */
    public function setPoliciesForCustomer($customerId, array $policies)
    {
        $trashed = [];
        $models = [];

        foreach ($policies as $idx => $attributes) {
            $isUpdated = (boolean)array_pull($attributes, 'updated');
            $isTrashed = (boolean)array_pull($attributes, 'trashed');

            if (!isset($attributes['id']) || empty($attributes['id'])) {
                array_pull($attributes, 'id');
                $attributes['customer_id'] = $customerId;

                $model = $this->model->create($attributes);
                $models[] = array_merge($model->toArray(), [
                    'index' => $idx,
                    'created' => true
                ]);
            } else if ($isUpdated) {
                $model = $this->model->find($attributes['id']);
                $model->update($attributes);

                $models[] = array_merge($model->toArray(), [
                    'updated' => true
                ]);
            } else if ($isTrashed) {
                $trashed[] = [
                    'id' => $attributes['id'],
                    'trashed' => true
                ];
            }
        }

        if (count($trashed)) {
            $ids = array_map(function ($item) {
                return $item['id'];
            }, $trashed);

            $trashing = $this->model->whereIn('id', $ids)->get();

            foreach ($trashing as $model) {
                $models[] = array_merge($model->toArray(), ['trashed' => true]);

                $model->delete();
            }
        }

        return $models;
    }

    /**
     * @param $quantity
     * @param $customerId
     * @param $productGroupId
     * @return mixed
     */
    public function getPriceBySalesUnitQuantity($quantity, $customerId, $productGroupId)
    {
        $price = $this->findWhere([
            'customer_id' => $customerId,
            'product_group_id' => $productGroupId,
            [function ($query) use ($quantity) {
                $query->where('products_range', '<=', $quantity);
            }, null, null]
        ])->min('price');

        if (!$price) {
            $price = $this->findWhere([
                'customer_id' => $customerId,
                'product_group_id' => $productGroupId
            ])->max('price');
        }

        return $price;
    }

    public function getByShopId($shopId, $ids = [])
    {
        $query = $this->model
            ->getQuery()
            ->where('customer_id', $shopId)
            ->where('price', '>', '0.00')
            ->where('products_range', '>', 0)
            ->whereNull('deleted_at');

        if ($ids) {
            $query->whereIn('id', $ids);
        }

        return $query->get();
    }
}
