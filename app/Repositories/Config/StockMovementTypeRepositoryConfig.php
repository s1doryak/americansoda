<?php

namespace App\Repositories\Config;

use App\Repositories\Contracts\StockMovementTypeRepository;
use Illuminate\Contracts\Config\Repository;

class StockMovementTypeRepositoryConfig implements StockMovementTypeRepository
{
    /**
     * @var Repository
     */
    private $config;

    /**
     * StockMovementTypeRepositoryConfig constructor.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

	/**
	 * @param array $columns
	 * @return \Illuminate\Support\Collection
	 */
    public function all(array $columns = ['*'])
    {
        return collect($this->config->get('stock.movement', []));
    }

	/**
	 * @param $column
	 * @param null $key
	 * @return \Illuminate\Support\Collection
	 */
    public function lists($column, $key = null)
    {
        return $this->all()->mapWithKeys(
            function ($item) {
                return [$item => $item];
            }
        );
    }

	/**
	 * @param $name
	 * @param string $direction
	 * @return $this
	 */
    public function orderBy($name, $direction = 'asc')
    {
        return $this;
    }
}