<?php

namespace App\Repositories\Contracts;

use Crmplease\MaterialAdmin\Repositories\RepositoryInterface as BaseRepository;

interface AdministratorRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function notifiable();
}
