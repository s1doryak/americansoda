<?php

namespace App\Repositories\Contracts;

interface CompanyBankAccountRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection|\App\CompanyBankAccount[]
     */
    public function getDefault();
}
