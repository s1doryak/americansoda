<?php

namespace App\Console\Commands\Resources;

use App\StockMovement;
use App\Repositories\Contracts\StockMovementRepository;
use App\Repositories\Contracts\StockRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * StockMovement resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class StockMovementCreator extends ResourceCreator
{
    protected $name = 'resource:create:stock_movement';

	/**
	 * @var StockRepository
	 */
	protected $stocks;


	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'stocks' => 'name',
	];

	public function __construct(
	    StockMovement $stockMovement,
		StockMovementRepository $stockMovementRepository,
		StockRepository $stockRepository
	)
	{
	    $this->resource = $stockMovement;
		$this->repository = $stockMovementRepository;
		$this->stocks = $stockRepository;

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
		return 'stock_movement';
	}

    /**
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
    }

	/**
	 * @param StockMovement $stock_movement
	 * @return array
	 */
	public function getEventAttributes($stock_movement)
	{
		return $stock_movement->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
