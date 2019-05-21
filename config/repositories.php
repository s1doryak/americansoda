<?php return [
	App\Repositories\Contracts\RegionRepository::class => App\Repositories\Eloquent\RegionRepositoryEloquent::class,
	App\Repositories\Contracts\CompanyRepository::class => App\Repositories\Eloquent\CompanyRepositoryEloquent::class,
	App\Repositories\Contracts\RoleRepository::class => App\Repositories\Eloquent\RoleRepositoryEloquent::class,
	App\Repositories\Contracts\UserRepository::class => App\Repositories\Eloquent\UserRepositoryEloquent::class,
	App\Repositories\Contracts\AdministratorRepository::class => App\Repositories\Eloquent\AdministratorRepositoryEloquent::class,
	App\Repositories\Contracts\BrandRepository::class => App\Repositories\Eloquent\BrandRepositoryEloquent::class,
	App\Repositories\Contracts\PackageTypeRepository::class => App\Repositories\Eloquent\PackageTypeRepositoryEloquent::class,
	App\Repositories\Contracts\ProductGroupRepository::class => App\Repositories\Eloquent\ProductGroupRepositoryEloquent::class,

    App\Repositories\Contracts\JobRepository::class => App\Repositories\Eloquent\JobRepositoryEloquent::class,
    App\Repositories\Contracts\FailedJobRepository::class => App\Repositories\Eloquent\FailedJobRepositoryEloquent::class,
];
