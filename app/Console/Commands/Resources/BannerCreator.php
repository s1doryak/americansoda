<?php

namespace App\Console\Commands\Resources;

use App\Banner;
use App\Repositories\Contracts\BannerRepository;
use App\Repositories\Contracts\CustomerTypeRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Banner resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class BannerCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:banner';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'banner';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var CustomerTypeRepository
	 */
	protected $customerTypes;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'customerTypes' => 'name',
	];

	public function __construct(
	    Banner $banner,
		BannerRepository $bannerRepository,
		CustomerTypeRepository $customerTypeRepository
	)
	{
	    $this->model = $banner;
		$this->repository = $bannerRepository;
		$this->customerTypes = $customerTypeRepository;

        parent::__construct();
	}

	/**
	 * @param Banner $banner
	 * @return array
	 */
	public function getEventAttributes($banner)
	{
		return $banner->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
