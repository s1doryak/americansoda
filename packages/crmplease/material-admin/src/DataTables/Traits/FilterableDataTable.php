<?php namespace Crmplease\MaterialAdmin\DataTables\Traits;

use DB;
use Illuminate\Support\Arr;

/**
 * Trait FilterableDataTable
 * @property \Illuminate\Database\Connection $connection
 * @property \Crmplease\MaterialAdmin\DataTables\Utilities\Request $request
 * @package Crmplease\MaterialAdmin\DataTables\Traits
 */
trait FilterableDataTable
{
	/**
	 * @return void
	 */
	public function filterable()
	{
		$this->filterable = [];

		foreach ($this->filterableColumns as $index => $column) {

			$filterable = [];

			if (is_array($column)) {
				$name = Arr::get($column, 'name', $index);
				$data = Arr::get($column, 'data', $name);
				$type = Arr::get($column, 'type', 'text');
				$lists = Arr::get($column, 'lists', $data);
				$items = Arr::get($column, 'items', null);
				$default = Arr::get($column, 'default', null);
			} else {
				if (is_numeric($index)) {
					$name = $column;
					$data = $name;
					$type = 'text';
					$lists = $data;
					$items = null;
					$default = null;
				} else {
					$name = $index;
					$data = $name;
					$type = $column;
					$lists = $data;
					$items = null;
					$default = null;
				}
			}

			$value = $this->request->filterValueByName($name, $default);

			try {

				/**
				 * TODO: Провести исследование.
				 * При вызове данного метода ломается исходный запрос, если отношение BelongsToMany
				 */
				$keyColumn = $this->joinFilterColumn($data);
				$nameColumn = $this->joinFilterColumn($lists);

				/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $filterQuery */
				$filterQuery = clone $this->query;

				if (is_array($items)) {
					$items = collect($items)->transform(
						function ($item, $key) {
							return is_array($item) ? $item : [
								'key' => $key,
								'value' => $item,
							];
						}
					);
				} else {

					if ($items instanceof \Closure) {
						call_user_func_array($items, [&$filterQuery, $keyColumn, $nameColumn]);
					} else {
						$filterQueryColumns = DB::raw(
							sprintf('DISTINCT %s as `value`, %s as `key`', $nameColumn, $keyColumn)
						);

						$filterQuery->select($filterQueryColumns)
							->orderBy($nameColumn)
							->whereNotNull($keyColumn)
							->whereNotNull($nameColumn);
					}

					$filterTable = $this->connection->raw('(' . $filterQuery->toSql() . ') filterable_table');

					$results = $this->connection
						->table($filterTable)
						->setBindings($filterQuery->getBindings())
						->get();

					if (!$results->isEmpty()) {
						$items = $results->toArray();
					}
				}

				$filterable['name'] = $name;
				$filterable['data'] = $data;
				$filterable['type'] = $type;
				$filterable['items'] = $items;
				$filterable['value'] = $value;
				$filterable['default'] = $default;

			} catch (\Exception $exception) {
				$filterable['name'] = $name;
				$filterable['data'] = $data;
				$filterable['type'] = $type;
				$filterable['items'] = [];
				$filterable['value'] = null;
				$filterable['default'] = null;
				$filterable['exception'] = [
					'message' => $exception->getMessage(),
					'file' => $exception->getFile(),
					'line' => $exception->getLine(),
					'code' => $exception->getCode(),
					'trace' => $exception->getTrace()
				];
			};

			$this->filterable[] = $filterable;
		}

		$this->with('filterable', $this->filterable);
	}

	/**
	 * @param array $columns
	 *
	 * @return $this
	 */
	public function filterableColumns(array $columns = [])
	{
		$this->filterableColumns = $columns;

		return $this;
	}
}
