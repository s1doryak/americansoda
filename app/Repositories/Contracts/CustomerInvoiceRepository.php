<?php

namespace App\Repositories\Contracts;

interface CustomerInvoiceRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * @return integer
     */
    public function getFirstAvailableNumber();
}
