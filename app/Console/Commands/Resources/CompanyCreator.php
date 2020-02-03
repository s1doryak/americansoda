<?php

namespace App\Console\Commands\Resources;

use App\Company;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\RegionRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Company resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CompanyCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:company';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'company';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var RegionRepository
	 */
	protected $regions;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'regions' => 'name',
	];

	public function __construct(
	    Company $company,
		CompanyRepository $companyRepository,
		RegionRepository $regionRepository
	)
	{
	    $this->model = $company;
		$this->repository = $companyRepository;
		$this->regions = $regionRepository;

        parent::__construct();
	}

	/**
	 * @param Company $company
	 * @return array
	 */
	public function getEventAttributes($company)
	{
		return $company->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
