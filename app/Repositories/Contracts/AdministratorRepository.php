<?php

namespace App\Repositories\Contracts;

interface AdministratorRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * @return mixed
     */
    public function notifiable();
}
