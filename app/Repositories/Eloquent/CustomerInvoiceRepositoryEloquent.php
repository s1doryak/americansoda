<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerInvoiceRepository;

class CustomerInvoiceRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerInvoiceRepository
{
    /**
     * @return integer
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getFirstAvailableNumber()
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = (integer)$this->model->max('invoice_nr') + 1;

        $this->resetModel();

        return $this->parserResult($results);
    }
}
