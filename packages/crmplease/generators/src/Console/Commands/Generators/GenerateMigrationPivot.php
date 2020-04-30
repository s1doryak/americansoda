<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class GenerateMigrationPivot extends GeneratorCommand implements HasModelAttributes
{
	use ModelAttributes;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $name = 'generate:migration:pivot';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate pivot table migration';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'MigrationPivot';

	/**
	 * Get class name.
	 *
	 * @return string
	 */
	protected function getClassName()
	{
		return sprintf('%s%s', $this->argument('a'), $this->argument('b'));
	}

	/**
	 * Replace the class name for the given stub.
	 *
	 * @param  string $stub
	 * @param  string $name
	 * @return string
	 */
	protected function replaceClass($stub, $name)
	{
		$stub = parent::replaceClass($stub, $name);

		$pivotFields = $this->getBelongsToManyPivot();
		$pivotTimestamps = $this->getBelongsToManyPivotTimestamps();

		$search = [
			'{{pivot_class_name}}',
			'{{pivot_table_name}}',
			'{{pivot_table_fields}}',
			'{{pivot_table_timestamps}}',
			'{{a_table}}',
			'{{b_table}}'
		];

		$replace = [
			sprintf('%s%s', $this->argument('a'), $this->argument('b')),
			sprintf('%s_%s', Str::snake($this->argument('a')), Str::snake($this->argument('b'))),
			$this->dumpMigrationPivotFields($pivotFields),
			$this->dumpMigrationPivotTimestamps($pivotTimestamps),
			Str::snake($this->argument('a')),
			Str::snake($this->argument('b'))
		];

		return str_replace($search, $replace, $stub);
	}

	/**
	 * Get the destination class path.
	 *
	 * @param  string $name
	 * @return string
	 */
	protected function getPath($name)
	{
		$a = Str::snake($this->argument('a'));

		$b = Str::snake($this->argument('b'));

		$template = '%s/database/migrations/%s_create_%s_%s_table.php';

		return sprintf($template, $this->basePath(), date('Y_m_d_His'), $a, $b);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['a', InputArgument::REQUIRED, 'The name of the primary table.'],
			['b', InputArgument::REQUIRED, 'The name of the slave table.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array_merge(
			$this->getGeneratorOptions(),
			$this->getModelOptions()
		);
	}
}
