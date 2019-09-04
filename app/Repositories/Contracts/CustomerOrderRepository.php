<?php

namespace App\Repositories\Contracts;

interface CustomerOrderRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * @param null $date
     * @param array $exclude
     * @return string
     */
    public function getFirstAvailableNumber($date = null, array $exclude = []);
}
