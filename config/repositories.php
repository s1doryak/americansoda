<?php return [
    App\Repositories\Contracts\JobRepository::class => App\Repositories\Eloquent\JobRepositoryEloquent::class,
    App\Repositories\Contracts\FailedJobRepository::class => App\Repositories\Eloquent\FailedJobRepositoryEloquent::class,
];
