<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasPolicyAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\PolicyAttributes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GeneratePolicy extends GeneratorCommand implements HasModelAttributes, HasPolicyAttributes
{
    use ModelAttributes, PolicyAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:policy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate policy';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Policy';

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return sprintf('%s\Policies', trim($rootNamespace, '\\'));
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

        $template = Str::endsWith('Policy', $name) ? '%s/%s.php' : '%s/%sPolicy.php';

        return sprintf($template, $this->appPath(), str_replace('\\', '/', $name));
    }

    /**
     * @return Collection
     */
    protected function getAuthenticatable()
    {
        $authenticatable = new Collection();

        foreach ($this->option('policy-auth') as $entity) {

            $parts = explode(':', $entity);

            $model = Str::singular(Str::studly($parts[0]));
            $policy = isset($parts[1]) ? trim($parts[1]) : 'true';

            $authenticatable->push((object)[
                'model' => $model,
                'policy' => $policy
            ]);
        }

        return $authenticatable;
    }

    /**
     * @param Collection $properties
     *
     * @return string
     */
    protected function dumpAuthenticatable(Collection $authenticatable)
    {
        $modelNamespace = $this->modelNamespace();

        return $authenticatable->map(
            function ($entity) use ($modelNamespace) {

                return sprintf("use %s%s;", $modelNamespace, $entity->model);

            }
        )->implode("\n");
    }

    /**
     * @param Collection $properties
     *
     * @return string
     */
    protected function dumpAuthenticatableCondition(Collection $authenticatable)
    {
        return $authenticatable->map(
            function ($entity) {

                return implode("\n", [
                    sprintf("\t\t\tcase %s::class:", $entity->model),
                    sprintf("\t\t\t\treturn %s;", $entity->policy),
                ]);

            }
        )->implode("\n");
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

        $policy = $this->getPolicy();

        $authenticatable = $this->getAuthenticatable();

        $search = [
            '{{policy}}',
            '{{policy_authenticatable}}',
            '{{policy_authenticatable_condition}}',
        ];

        $replace = [
            $this->dumpPolicy($policy),
            $this->dumpAuthenticatable($authenticatable),
            $this->dumpAuthenticatableCondition($authenticatable)
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
            $this->getPolicyOptions()
        );
    }

    /**
     * Display success message to console.
     */
    protected function success()
    {
        parent::success();

        $name = $this->argument('name');

        $this->updateCodeSuggestion(
            'app/Providers/AuthServiceProvider.php',
            '$policies',
            sprintf(
                "\App\%s::class => \App\Policies\%sPolicy::class,",
                $name,
                $name
            ),
            2,
            'array_var'
        );
    }
}
