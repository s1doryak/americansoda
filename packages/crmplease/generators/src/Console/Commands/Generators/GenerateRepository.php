<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Traits\RepositoryAttributes;
use Illuminate\Support\Str;

class GenerateRepository extends GeneratorCommand
{
    use RepositoryAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    public function handle()
    {
        if (false === $name = $this->handleName()) {
            return false;
        }

        if (parent::handle() === false) {
            return false;
        }

        if ($this->isEloquent()) {
            $this->createEloquent();
        }

        return true;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = 'contracts';

        return sprintf('%s\Repositories\%s', trim($rootNamespace, '\\'), Str::studly($namespace));
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

        $template = Str::endsWith('Repository', $name) ? '%s/%s.php' : '%s/%sRepository.php';

        return sprintf($template, $this->appPath(), str_replace('\\', '/', $name));
    }

    protected function createEloquent()
    {
        $name = $this->argument('name');

        $this->call('generate:repository:eloquent', [
            'name' => $name,
            '--package' => $this->option('package'),
        ]);
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
            $this->getRepositoryOptions()
        );
    }
}
