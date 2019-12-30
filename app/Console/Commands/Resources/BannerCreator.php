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
    protected $name = 'resource:create:banner';


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
	    $this->resource = $banner;
		$this->repository = $bannerRepository;
		$this->customerTypes = $customerTypeRepository;

        parent::__construct();
	}

	/**
	 * @return string
	 */
	public function getEventNamespace()
	{
		return 'cli';
	}

	/**
	 * @return string
	 */
	public function getEventResource()
	{
		return 'banner';
	}

    /**
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
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
