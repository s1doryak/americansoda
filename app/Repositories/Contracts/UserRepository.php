<?php

namespace App\Repositories\Contracts;

interface UserRepository extends \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection|\App\User[]
     */
    public function notifiable();
}
