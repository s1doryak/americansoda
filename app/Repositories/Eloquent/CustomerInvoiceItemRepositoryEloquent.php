<?php

namespace App\Repositories\Eloquent;

use App\CustomerInvoiceItem;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;

class CustomerInvoiceItemRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerInvoiceItemRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerInvoiceItem::class;
    }
}
