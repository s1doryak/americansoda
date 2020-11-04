<?php

namespace App\Services\Api\V1;

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
            ->pluck('product_id');
    }
}
