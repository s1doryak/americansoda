<?php

namespace App\Repositories\Contracts;

interface StockMovementTypeRepository
{
	/**
	 * @param array $columns
	 * @return \Illuminate\Support\Collection
	 */
	public function all(array $columns = ['*']);

	/**
	 * @param $column
	 * @param null $key
	 * @return \Illuminate\Support\Collection
	 */
	public function lists($column, $key = null);

	/**
	 * @param $name
	 * @param string $direction
	 * @return $this
	 */
	public function orderBy($name, $direction = 'asc');
}