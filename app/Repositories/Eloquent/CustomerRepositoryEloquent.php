<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CustomerRepository;

class CustomerRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CustomerRepository
{
    /**
     * @param array $exclude
     * @return integer
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getFirstAvailableNumber(array $exclude = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = (integer)$this->model->whereNotIn('id', $exclude)->max('nr') + 1;

        $this->resetModel();

        return $this->parserResult($results);
    }
}
