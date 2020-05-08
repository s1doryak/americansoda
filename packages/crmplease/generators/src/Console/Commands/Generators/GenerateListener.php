<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class GenerateListener extends GeneratorCommand implements HasModelAttributes, HasNamespaceAttributes
{
    use ModelAttributes, NamespaceAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate listener';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Listener';

    /**
     * @return Collection
     */
    protected function getResources()
    {
        $resources = new Collection();

        foreach ($this->option('listener-resource') as $resource) {

            $resources->push(
                (object)[
                    'model' => Str::studly($resource),
                    'table' => Str::plural(Str::snake($resource)),
                    'repository' => Str::plural(Str::camel($resource)),
                ]
            );

        }

        return $resources;
    }

    /**
     * @return Collection
     */
    protected function getRepositories()
    {
        $modelNamespace = $this->modelNamespace();

        $repositories = $this->getResources()->pluck('model')->map(
            function ($class) use ($modelNamespace) {
                return Str::replaceFirst($modelNamespace, '', $class);
            }
        )->unique()->map(
            function ($class) {
                return sprintf('%sRepository', $class);
            }
        );

        return $repositories;
    }

    /**
     * @return Collection
     */
    protected function getProperties()
    {
        $modelNamespace = $this->modelNamespace();

        $properties = $this->getResources()->mapWithKeys(
            function ($item) use ($modelNamespace) {
                return [
                    $item->repository => sprintf(
                        '%sRepository',
                        Str::replaceFirst($modelNamespace, '', $item->model)
                    ),
                ];
            }
        );

        return $properties;
    }

    /**
     * @return Collection
     */
    protected function getValidNamespaces()
    {
        $namespace = $this->option('namespace') ?: self::DEFAULT_NAMESPACE;

        return collect([Str::snake($namespace)]);
    }

    /**
     * @param Collection $namespaces
     *
     * @return string
     */
    protected function dumpValidNamespaces(Collection $namespaces)
    {
        return $namespaces->map(
            function ($namespace) {
                return sprintf("\t\t\t'%s',", $namespace);
            }
        )->implode("\n");
    }

    /**
     * @return Collection
     */
    protected function getValidResources()
    {
        return $this->getResources()->pluck('model')->map(
            function ($resource) {
                return Str::snake(Str::singular($resource));
            }
        );
    }

    /**
     * @param Collection $resources
     *
     * @return string
     */
    protected function dumpValidResources(Collection $resources)
    {
        return $resources->map(
            function ($resource) {
                return sprintf("\t\t\t'%s',", $resource);
            }
        )->implode("\n");
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = $this->option('namespace') ?: self::DEFAULT_NAMESPACE;

        return sprintf('%s\Listeners\%s', trim($rootNamespace, '\\'), Str::studly($namespace));
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $template = '%s/%s.php';

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

        $namespaces = $this->getValidNamespaces();

        $resources = $this->getValidResources();

        $search = [
            '{{listener_repositories}}',
            '{{listener_properties}}',
            '{{listener_constructor_phpdoc}}',
            '{{listener_constructor_signature}}',
            '{{listener_constructor_body}}',
            '{{listener_valid_namespaces}}',
            '{{listener_valid_resources}}',
        ];

        $replace = [
            $this->dumpRepositories($repositories),
            $this->dumpProperties($properties),
            $this->dumpConstructorPhpDoc($repositories),
            $this->dumpConstructorSignature($repositories),
            $this->dumpConstructorBody($properties, false),
            $this->dumpValidNamespaces($namespaces),
            $this->dumpValidResources($resources),
        ];

        return str_replace($search, $replace, $stub);
    }

    /**
     * @return array
     */
    protected function getListenerOptions()
    {
        return [
            ['listener-resource', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Listener resource.'],
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
            $this->getListenerOptions(),
            $this->getNamespaceOptions()
        );
    }

    /**
     * Display success message to console.
     */
    protected function success()
    {
        parent::success();

        $this->info("Add the following line to your app/Providers/EventServiceProvider.php at needed section:");
        $this->comment(
            sprintf(
                "\%s\%s::class,",
                $this->getDefaultNamespace($this->rootNamespace()),
                $this->getClassName()
            )
        );
    }
}
