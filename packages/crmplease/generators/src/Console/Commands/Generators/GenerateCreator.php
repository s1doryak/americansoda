<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Illuminate\Support\Str;

class GenerateCreator extends GeneratorCommand implements HasModelAttributes
{
    use ModelAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:creator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate creator';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Creator';

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return sprintf('%s\Console\Commands\Resources', trim($rootNamespace, '\\'));
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::singular(Str::replaceFirst($this->rootNamespace(), '', $name));

        $template = Str::endsWith('Creator', $name) ? '%s/%s.php' : '%s/%sCreator.php';

        return sprintf($template, $this->appPath(), str_replace('\\', '/', $name));
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $repositories = $this->getRepositories();

        $properties = $this->getProperties();

        $findOrCreateData = $this->getFindOrCreateData();

        $search = [
            '{{resource}}',
            '{{creator_repositories}}',
            '{{creator_properties}}',
            '{{creator_constructor_signature}}',
            '{{creator_constructor_body}}',
            '{{creator_find_or_create_data}}',
        ];

        $replace = [
            Str::snake($this->argument('name')),
            $this->dumpRepositories($repositories),
            $this->dumpProperties($properties),
            $this->dumpConstructorSignature($repositories),
            $this->dumpConstructorBody($properties),
            $this->dumpFindOrCreateData($findOrCreateData)
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

    /**
     * Display success message to console.
     */
    protected function success()
    {
        parent::success();

        $this->updateCodeSuggestion(
            'app/Console/Kernel.php',
            '$commands',
            sprintf(
                "\App\Console\Commands\Resources\%sCreator::class,",
                Str::studly($this->argument('name'))
            ),
            2,
            'array_var'
        );
    }
}
