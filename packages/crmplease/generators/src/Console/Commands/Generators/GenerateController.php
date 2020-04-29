<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Illuminate\Support\Str;

class GenerateController extends GeneratorCommand implements HasModelAttributes, HasNamespaceAttributes
{
    use ModelAttributes, NamespaceAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = $this->option('namespace') ?: self::DEFAULT_NAMESPACE;

        return sprintf('%s\Http\Controllers\%s', trim($rootNamespace, '\\'), Str::studly($namespace));
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
        $name = Str::plural(Str::replaceFirst($this->rootNamespace(), '', $name));

        $template = Str::endsWith('Controller', $name) ? '%s/%s.php' : '%s/%sController.php';

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

        $with = $this->getWith();

        $repositories = $this->getRepositories();

        $properties = $this->getProperties();

        $formConfigData = $this->getFormConfigData();

        $search = [
            '{{prefix}}',
            '{{resource}}',
            '{{controller_with}}',
            '{{controller_repositories}}',
            '{{controller_properties}}',
            '{{controller_constructor_phpdoc}}',
            '{{controller_constructor_signature}}',
            '{{controller_constructor_body}}',
            '{{controller_form_data}}',
        ];

        $replace = [
            Str::snake($this->option('namespace')),
            Str::snake($this->argument('name')),
            $this->dumpWith($with),
            $this->dumpRepositories($repositories),
            $this->dumpProperties($properties),
            $this->dumpConstructorPhpDoc($repositories),
            $this->dumpConstructorSignature($repositories),
            $this->dumpConstructorBody($properties),
            $this->dumpFormConfigData($formConfigData),
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
            $this->getModelOptions(),
            $this->getNamespaceOptions()
        );
    }

    /**
     * Display success message to console.
     */
    protected function success()
    {
        parent::success();

        $this->updateCodeSuggestion(
            'config/resources.php',
            'php',
            sprintf(
                "'%s' => \App\%s::class,",
                Str::snake($this->argument('name')),
                Str::studly($this->argument('name'))
            ),
            1,
            'array_return'
        );
    }
}
