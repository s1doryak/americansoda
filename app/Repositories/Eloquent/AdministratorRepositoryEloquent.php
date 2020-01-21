<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AdministratorRepository;

class AdministratorRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements AdministratorRepository
{
    /**
     * @return mixed
     */
    public function notifiable()
    {
        return $this->all();
    }
}
