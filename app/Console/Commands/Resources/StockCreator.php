<?php

namespace App\Console\Commands\Resources;

use App\Stock;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\RegionRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Stock resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class StockCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:stock';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'stock';

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
	    Stock $stock,
		StockRepository $stockRepository,
		RegionRepository $regionRepository
	)
	{
	    $this->model = $stock;
		$this->repository = $stockRepository;
		$this->regions = $regionRepository;

        parent::__construct();
	}

	/**
	 * @param Stock $stock
	 * @return array
	 */
	public function getEventAttributes($stock)
	{
		return $stock->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
