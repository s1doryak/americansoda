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
    protected $name = 'resource:create:company';

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
	    $this->resource = $company;
		$this->repository = $companyRepository;
		$this->regions = $regionRepository;

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
		return 'company';
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
