<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Symfony\Component\Console\Input\InputOption;

trait PolicyAttributes
{
	/**
	 * @return integer
	 */
	protected function getPolicy()
	{
		if ($this->option('policy')) {
			return (string)$this->option('policy');
		}

		return self::POLICY;
	}

	/**
	 * @param string $policy
	 * @return string
	 */
	protected function dumpPolicy($policy)
	{
		return (string)$policy;
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getPolicyOptions()
	{
		return [
			['policy', null, InputOption::VALUE_OPTIONAL, 'Resource default policy.'],
			['policy-auth', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource authenticatable entity.'],
		];
	}
}
