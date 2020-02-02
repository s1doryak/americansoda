<?php

namespace App\Repositories\Eloquent;

use App\CustomerInvoiceAttachment;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;

class CustomerInvoiceAttachmentRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerInvoiceAttachmentRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CustomerInvoiceAttachment::class;
    }
}
