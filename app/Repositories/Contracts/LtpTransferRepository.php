<?php

namespace App\Repositories\Contracts;

interface LtpTransferRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * @return string
     */
    public function getFirstAvailableNumber();
}
