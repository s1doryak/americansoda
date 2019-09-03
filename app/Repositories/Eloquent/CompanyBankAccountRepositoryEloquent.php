<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CompanyBankAccountRepository;

class CompanyBankAccountRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements CompanyBankAccountRepository
{
    /**
     * @return \Illuminate\Support\Collection|\App\CompanyBankAccount[]
     */
    public function getDefault()
    {
        return $this->findWhere([
            'default' => true
        ]);
    }
}
