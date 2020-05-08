<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Illuminate\Support\Str;

class GenerateRepositoryEloquent extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:repository:eloquent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate repository eloquent';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'RepositoryEloquent';

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = 'eloquent';

        return sprintf('%s\Repositories\%s', trim($rootNamespace, '\\'), Str::studly($namespace));
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
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $template = Str::endsWith('RepositoryEloquent', $name) ? '%s/%s.php' : '%s/%sRepositoryEloquent.php';

        return sprintf($template, $this->appPath(), str_replace('\\', '/', $name));
    }

    /**
     * Display success message to console.
     */
    protected function success()
    {
        parent::success();

        $this->updateCodeSuggestion(
            'config/repositories.php',
            'php',
            sprintf(
                'App\Repositories\Contracts\%1$sRepository::class => App\Repositories\Eloquent\%1$sRepositoryEloquent::class,',
                Str::studly($this->argument('name'))
            ),
            1,
            'array_return'
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(
            $this->getGeneratorOptions()
        );
    }
}
