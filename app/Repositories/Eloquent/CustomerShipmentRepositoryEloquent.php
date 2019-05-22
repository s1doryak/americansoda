<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerShipmentRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerShipmentRepositoryEloquent extends BaseRepositoryEloquent implements CustomerShipmentRepository {}