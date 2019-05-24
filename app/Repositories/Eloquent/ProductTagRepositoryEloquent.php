<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductTagRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class ProductTagRepositoryEloquent extends BaseRepositoryEloquent implements ProductTagRepository {}