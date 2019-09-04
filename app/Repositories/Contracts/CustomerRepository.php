<?php

namespace App\Repositories\Contracts;

interface CustomerRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * @param array $exclude
     * @return integer
     */
    public function getFirstAvailableNumber(array $exclude = []);
}
