<?php

namespace App\Repositories\Eloquent;

use App\CustomerInvoiceAction;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;

class CustomerInvoiceActionRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerInvoiceActionRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerInvoiceAction::class;
    }
}
