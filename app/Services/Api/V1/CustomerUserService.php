<?php

namespace App\Services\Api\V1;

use App\Repositories\Eloquent\CustomerUserRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;
use Illuminate\Support\Facades\Auth;

class CustomerUserService extends ResourceService
{
    public function __construct()
    {
        $this->setRepository(CustomerUserRepositoryEloquent::class);
    }

    public function getProfile()
    {
        return $this
            ->repository
            ->with(['customers', 'customers.user'])
            ->firstWhere(['id' => Auth::id()]);
    }
}