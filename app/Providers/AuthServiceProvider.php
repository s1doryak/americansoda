<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		\App\Region::class => \App\Policies\RegionPolicy::class,
		\App\Company::class => \App\Policies\CompanyPolicy::class,
		\App\Role::class => \App\Policies\RolePolicy::class,
		\App\User::class => \App\Policies\UserPolicy::class,
		\App\Administrator::class => \App\Policies\AdministratorPolicy::class,

        \App\Job::class => \App\Policies\JobPolicy::class,
        \App\FailedJob::class => \App\Policies\FailedJobPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
