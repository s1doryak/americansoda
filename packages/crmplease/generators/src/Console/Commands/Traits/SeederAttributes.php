<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Symfony\Component\Console\Input\InputOption;

trait SeederAttributes
{
	/**
	 * @return integer
	 */
	protected function getSeedCount()
	{
		if ($this->option('seed-count')) {
			return (integer)$this->option('seed-count');
		}

		return self::SEED_COUNT;
	}

	/**
	 * @param integer $count
	 * @return string
	 */
	protected function dumpSeedCount($count)
	{
		return (string)$count;
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getSeederOptions()
	{
		return [
			['seed-count', null, InputOption::VALUE_OPTIONAL, 'Resource seeder factory count.'],
		];
	}
}
