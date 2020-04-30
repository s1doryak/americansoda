<?php

namespace Crmplease\MaterialAdmin\Database\Schema;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Blueprint extends \Illuminate\Database\Schema\Blueprint
{
	/**
	 * @param string|array $column
	 * @param string $onDelete
	 * @return mixed
	 */
	public function fk($column, $onDelete = 'cascade', $nullable = false)
	{
		$table = null;
		$fkname = hash('md5', $this->createIndexName('foreign', (array)$column));

		if (is_array($column)) {
			$source = $column;
			$type = Arr::get($source, 'type', 'unsignedBigInteger');
			$table = Arr::get($source, 'table');
			$column = Arr::get($source, 'column');
			$fkname = Arr::get($source, 'fkname', $fkname);
			$blueprint = $this->{$type}($column);
		} else {
			$blueprint = $this->unsignedBigInteger($column);
		}

		if ($nullable) {
			$blueprint->nullable();
		}

		if ($table === null) {
			$table = Str::plural(substr($column, 0, strrpos($column, '_id')));
		}

		return $blueprint->foreign($column, $fkname)
			->references('id')
			->on($table)
			->onDelete($onDelete);
	}

	/**
	 * @param array $columns
	 * @param string $onDelete
	 */
	public function fks(array $columns, $onDelete = 'cascade', $nullable = false)
	{
		foreach ($columns as $column) {
			$this->fk($column, $onDelete, $nullable);
		}
	}
}
