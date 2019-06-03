<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerInvoiceRepositoryEloquent extends BaseRepositoryEloquent implements CustomerInvoiceRepository {}