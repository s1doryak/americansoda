<?php

namespace App\Repositories\Eloquent;

use App\PaymentType;
use App\Repositories\Contracts\PaymentTypeRepository;

class PaymentTypeRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements PaymentTypeRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return PaymentType::class;
    }
}
