<?php return [
	App\Repositories\Contracts\RegionRepository::class => App\Repositories\Eloquent\RegionRepositoryEloquent::class,

    App\Repositories\Contracts\JobRepository::class => App\Repositories\Eloquent\JobRepositoryEloquent::class,
    App\Repositories\Contracts\FailedJobRepository::class => App\Repositories\Eloquent\FailedJobRepositoryEloquent::class,
];
