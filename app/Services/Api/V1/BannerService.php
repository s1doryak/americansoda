<?php

namespace App\Services\Api\V1;

use App\Repositories\Contracts\BannerRepository;
use App\Repositories\Eloquent\BannerRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class BannerService extends ResourceService
{
    /**
     * @var BannerRepositoryEloquent
     */
    protected $repository;

    /**
     * @param BannerRepository $bannerRepository
     */
    public function __construct(
        BannerRepository $bannerRepository
    )
    {
        $this->repository = $bannerRepository;
    }
}
