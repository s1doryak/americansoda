<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Eloquent\CustomerUserRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Facades\Auth;

class CustomerUserService extends ResourceService
{
    /**
     * @var CustomerUserRepositoryEloquent
     */
    protected $repository;

    public function __construct()
    {
        $this->setRepository(CustomerUserRepository::class);
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function getProfile()
    {
        return Auth::user()
            ->has('customers')
            ->has('customers.user')
            ->with(['customers' => function ($query) {
                /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                return $query->whereNull('deleted_at');
            }, 'customers.user'])
            ->first();
    }
}
