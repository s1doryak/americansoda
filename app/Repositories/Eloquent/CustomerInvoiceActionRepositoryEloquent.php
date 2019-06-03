<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent as BaseRepositoryEloquent;

class CustomerInvoiceActionRepositoryEloquent extends BaseRepositoryEloquent implements CustomerInvoiceActionRepository {}