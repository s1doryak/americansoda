<?php

namespace App\Repositories\Eloquent;

use App\Administrator;
use App\Repositories\Contracts\AdministratorRepository;

class AdministratorRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements AdministratorRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Administrator::class;
    }

    /**
     * @return mixed
     */
    public function notifiable()
    {
        return $this->all();
    }
}
