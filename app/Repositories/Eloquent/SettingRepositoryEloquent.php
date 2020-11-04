<?php

namespace App\Repositories\Eloquent;

use App\Setting;
use App\Repositories\Contracts\SettingRepository;

/**
 * Class SettingRepositoryEloquent
 * @package App\Repositories\Eloquent
 */
class SettingRepositoryEloquent extends \Crmplease\MaterialAdmin\Repositories\RepositoryEloquent implements SettingRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }
}
