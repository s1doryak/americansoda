<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerInvoiceItemRepositoryEloquent extends BaseRepositoryEloquent implements CustomerInvoiceItemRepository {}