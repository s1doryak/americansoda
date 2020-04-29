<?php

namespace Crmplease\MaterialAdmin\Support\Facades;

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;

class Schema extends \Illuminate\Support\Facades\Schema
{
	/**
	 * Get a schema builder instance for the default connection.
	 *
	 * @return \Illuminate\Database\Schema\Builder
	 */
	protected static function getFacadeAccessor()
	{
		$builder = static::$app['db']->connection()->getSchemaBuilder();
		$builder->blueprintResolver(function($table, $callback) {
			$blueprint =  new Blueprint($table, $callback);
			$blueprint->engine = 'InnoDB';

			return $blueprint;
		});

		return $builder;
	}
}
