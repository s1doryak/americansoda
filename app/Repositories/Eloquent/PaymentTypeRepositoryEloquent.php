<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PaymentTypeRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class PaymentTypeRepositoryEloquent extends BaseRepositoryEloquent implements PaymentTypeRepository {}