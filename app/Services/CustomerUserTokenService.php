<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerUserTokenRepository;
use Crmplease\MaterialAdmin\Services\EntityService;

class CustomerUserTokenService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(CustomerUserTokenRepository::class);
    }
}