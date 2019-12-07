<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\CustomerUserRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class CustomerUserService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(CustomerUserRepositoryEloquent::class);
    }

    public function getProfile()
    {
        return Auth::user()
            ->with(['customers', 'customers.user'])
            ->whereHas('customers', function ($query) {
                return $query->whereNull('deleted_at');
            })
            ->first();
    }
}