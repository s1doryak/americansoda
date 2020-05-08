<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Illuminate\Support\Str;

class GenerateFactory extends GeneratorCommand implements HasModelAttributes
{
	use ModelAttributes;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $name = 'generate:factory';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate factory';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Factory';

	/**
	 * Get the destination class path.
	 *
	 * @param  string $name
	 * @return string
	 */
	protected function getPath($name)
	{
        $name = Str::snake($this->argument('name'));

        $factory = sprintf('%s_factory', $name);

        $template = '%s/database/factories/%s.php';

        return sprintf($template, $this->basePath(), Str::studly($factory));
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

        $fields = $this->getFactoryFields();

        $search = [
            '{{factory_fields}}',
        ];

        $replace = [
            $this->dumpFactoryFields($fields),
        ];

        return str_replace($search, $replace, $stub);
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
