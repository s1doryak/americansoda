<?php

namespace App\Services\Api\V1;

use App\CustomerUserSubscribe;
use App\Repositories\Contracts\CustomerUserSubscribeRepository;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Facades\Auth;

class CustomerUserSubscribeService extends ResourceService
{
    public function __construct(
        CustomerUserSubscribeRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create($product)
    {
        $this->repository->create([
            'customer_user_id' => Auth::id(),
            'product_id' => $product
        ]);
    }

    public function search($where = [])
    {
        $where = array_merge($where, [
            'customer_user_id' => Auth::id()
        ]);

        return $this
            ->repository
            ->findWhere($where)
            ->map(function (CustomerUserSubscribe $subscribe) {
                return [
                    'id' => $subscribe->getKey(),
                    'product' => $subscribe->product->name,
                    'subscribed' => $subscribe->created_at->format('y/m/d H:i'),
                    'status' => $subscribe->product->getFutureStockMovementWeeks()
                ];
            });
    }
}
