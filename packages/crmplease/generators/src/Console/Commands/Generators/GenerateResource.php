<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasPolicyAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasSeederAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\PolicyAttributes;
use Crmplease\Generators\Console\Commands\Traits\ResourceAttributes;
use Crmplease\Generators\Console\Commands\Traits\SeederAttributes;
use Crmplease\Generators\Console\Commands\Traits\TranslateAttributes;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class GenerateResource extends GeneratorCommand implements HasModelAttributes, HasNamespaceAttributes, HasPolicyAttributes, HasSeederAttributes
{
    use ModelAttributes, NamespaceAttributes, PolicyAttributes, ResourceAttributes, SeederAttributes, TranslateAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate resource';

    /**
     * Resource directories.
     *
     * @var array
     */
    protected $resourceDirectories = [
        'resources/views/{{namespace_snake_case}}/resources/{{resource_snake_case}}/columns',
        'resources/views/{{namespace_snake_case}}/resources/{{resource_snake_case}}/fields',
        'resources/views/{{namespace_snake_case}}/resources/{{resource_snake_case}}/filters',
    ];

    /**
     * Resource files.
     *
     * @var array
     */
    protected $resourceFiles = [
        'resources/views/{{namespace_snake_case}}/resources/{{resource_snake_case}}/create.blade.php' => 'views/create',
        'resources/views/{{namespace_snake_case}}/resources/{{resource_snake_case}}/index.blade.php' => 'views/index',
        'resources/views/{{namespace_snake_case}}/resources/{{resource_snake_case}}/show.blade.php' => 'views/show',
    ];

    /**
     * @var array
     */
    protected $defaultLabels = [];

    /**
     * Get the stub file for the generator.
     *
     * @param string $type
     * @return string
     */
    protected function getStub($type = '')
    {
        return sprintf(__DIR__ . '/stubs/resource/%s.stub', $type);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $namespace = $this->option('namespace');

        $search = [
            '{{resource_studly_case}}',
            '{{resource_camel_case}}',
            '{{resource_snake_case}}',
            '{{namespace_studly_case}}',
            '{{namespace_camel_case}}',
            '{{namespace_snake_case}}',
        ];

        $replace = [
            Str::studly($name),
            Str::camel($name),
            Str::snake($name),
            Str::studly($namespace),
            Str::camel($namespace),
            Str::snake($namespace),
        ];

        return str_replace($search, $replace, $stub);
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @param string $type
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name, $type = '')
    {
        $stub = $this->files->get($this->getStub($type));

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Generate resource files.
     *
     * @return boolean|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if (false === $name = $this->handleName()) {
            return false;
        }

        $namespace = $this->handleNamespace(self::DEFAULT_NAMESPACE);

        $search = [
            '{{resource_studly_case}}',
            '{{resource_camel_case}}',
            '{{resource_snake_case}}',
            '{{namespace_studly_case}}',
            '{{namespace_camel_case}}',
            '{{namespace_snake_case}}',
        ];

        $replace = [
            Str::studly($name),
            Str::camel($name),
            Str::snake($name),
            Str::studly($namespace),
            Str::camel($namespace),
            Str::snake($namespace),
        ];

        /**
         * Make directories
         */
        foreach ($this->resourceDirectories as $directory) {

            $path = $this->basePath(str_replace($search, $replace, $directory));

            $this->makeDirectory($path);
        }

        /**
         * Make files
         */
        foreach ($this->resourceFiles as $file => $type) {

            $path = $this->basePath(str_replace($search, $replace, $file));

            $this->makeFile($path, $this->buildClass($name, $type));
        }

        if ($this->modelEnabled()) {
            $this->call(
                'generate:model',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--namespace' => $this->option('namespace'),
                    '--auth' => $this->option('auth'),
                    '--uuid' => $this->option('uuid'),
                    '--field' => $this->option('field'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--belongs-to-many' => $this->option('belongs-to-many'),
                    '--belongs-to-many-pivot' => $this->option('belongs-to-many-pivot'),
                    '--belongs-to-many-pivot-timestamps' => $this->option('belongs-to-many-pivot-timestamps'),
                    '--has-one' => $this->option('has-one'),
                    '--has-many' => $this->option('has-many'),
                    '--has-many-through' => $this->option('has-many-through'),
                    '--morph-to' => $this->option('morph-to'),
                    '--morph-one' => $this->option('morph-one'),
                    '--morph-many' => $this->option('morph-many'),
                    '--morph-to-many' => $this->option('morph-to-many'),
                    '--morphed-by-many' => $this->option('morphed-by-many'),
                ]
            );
        } else {
            $this->line('Skipping model creation.');
        }

        if ($this->repositoryEnabled()) {

            $this->call(
                'generate:repository',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--eloquent' => true,
                ]
            );

        } else {
            $this->line('Skipping repository creation.');
        }

        if ($this->policyEnabled()) {

            $this->call(
                'generate:policy',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--policy' => $this->option('policy'),
                    '--policy-auth' => $this->option('policy-auth'),
                ]
            );

        } else {
            $this->line('Skipping policy creation.');
        }

        if ($this->migrationEnabled()) {

            $this->call(
                'generate:migration',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--auth' => $this->option('auth'),
                    '--uuid' => $this->option('uuid'),
                    '--field' => $this->option('field'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--morph-to' => $this->option('morph-to'),
                ]
            );

            if ($this->isAuthResource()) {

                sleep(1);

                $this->call(
                    'generate:migration:password_resets',
                    [
                        'name' => $name,
                        '--package' => $this->option('package'),
                    ]
                );
            }

            $this->getBelongsToMany()->each(
                function ($relation) use ($name) {

                    sleep(1);

                    $this->call(
                        'generate:migration:pivot',
                        [
                            'a' => Str::singular($name),
                            'b' => Str::singular($relation->relation),
                            '--package' => $this->option('package'),
                            '--belongs-to-many' => $this->option('belongs-to-many'),
                            '--belongs-to-many-pivot' => $this->option('belongs-to-many-pivot'),
                            '--belongs-to-many-pivot-timestamps' => $this->option('belongs-to-many-pivot-timestamps'),
                        ]
                    );

                }
            );

        } else {
            $this->line('Skipping migrations creation.');
        }

        if ($this->controllerEnabled()) {

            $this->call(
                'generate:controller',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--namespace' => $this->option('namespace'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--belongs-to-many' => $this->option('belongs-to-many'),
                    '--has-one' => $this->option('has-one'),
                    '--has-many' => $this->option('has-many'),
                    '--has-many-through' => $this->option('has-many-through'),
                    '--morph-to' => $this->option('morph-to'),
                    '--morph-one' => $this->option('morph-one'),
                    '--morph-many' => $this->option('morph-many'),
                    '--morph-to-many' => $this->option('morph-to-many'),
                    '--morphed-by-many' => $this->option('morphed-by-many'),
                ]
            );

        } else {
            $this->line('Skipping controller creation.');
        }

        if ($this->formEnabled()) {

            $this->call(
                'generate:form',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--namespace' => $this->option('namespace'),
                    '--auth' => $this->option('auth'),
                    '--uuid' => $this->option('uuid'),
                    '--field' => $this->option('field'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--belongs-to-many' => $this->option('belongs-to-many'),
                    '--has-one' => $this->option('has-one'),
                    '--has-many' => $this->option('has-many'),
                    '--has-many-through' => $this->option('has-many-through'),
                    '--morph-to' => $this->option('morph-to'),
                    '--morph-one' => $this->option('morph-one'),
                    '--morph-many' => $this->option('morph-many'),
                    '--morph-to-many' => $this->option('morph-to-many'),
                    '--morphed-by-many' => $this->option('morphed-by-many'),
                ]
            );

        } else {
            $this->line('Skipping form creation.');
        }

        if ($this->transformerEnabled()) {

            $this->call(
                'generate:transformer',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--namespace' => $this->option('namespace'),
                    '--auth' => $this->option('auth'),
                    '--uuid' => $this->option('uuid'),
                    '--field' => $this->option('field'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--belongs-to-many' => $this->option('belongs-to-many'),
                    '--has-one' => $this->option('has-one'),
                    '--has-many' => $this->option('has-many'),
                    '--has-many-through' => $this->option('has-many-through'),
                    '--morph-to' => $this->option('morph-to'),
                    '--morph-one' => $this->option('morph-one'),
                    '--morph-many' => $this->option('morph-many'),
                    '--morph-to-many' => $this->option('morph-to-many'),
                    '--morphed-by-many' => $this->option('morphed-by-many'),
                ]
            );

        } else {
            $this->line('Skipping transformer creation.');
        }

        if ($this->datatableEnabled()) {

            $this->call(
                'generate:datatable',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--namespace' => $this->option('namespace'),
                    '--auth' => $this->option('auth'),
                    '--uuid' => $this->option('uuid'),
                    '--field' => $this->option('field'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--belongs-to-many' => $this->option('belongs-to-many'),
                    '--has-one' => $this->option('has-one'),
                    '--has-many' => $this->option('has-many'),
                    '--has-many-through' => $this->option('has-many-through'),
                    '--morph-to' => $this->option('morph-to'),
                    '--morph-one' => $this->option('morph-one'),
                    '--morph-many' => $this->option('morph-many'),
                    '--morph-to-many' => $this->option('morph-to-many'),
                    '--morphed-by-many' => $this->option('morphed-by-many'),
                ]
            );

        } else {
            $this->line('Skipping datatable creation.');
        }

        if ($this->factoryEnabled()) {

            $this->call(
                'generate:factory',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--auth' => $this->option('auth'),
                    '--uuid' => $this->option('uuid'),
                    '--field' => $this->option('field'),
                ]
            );

        } else {
            $this->line('Skipping factory creation.');
        }

        if ($this->seederEnabled()) {

            $this->call(
                'generate:seeder',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--belongs-to-many' => $this->option('belongs-to-many'),
                    '--belongs-to-many-pivot' => $this->option('belongs-to-many-pivot'),
                    '--belongs-to-many-pivot-timestamps' => $this->option('belongs-to-many-pivot-timestamps'),
                    '--seed-count' => $this->option('seed-count'),
                ]
            );

        } else {
            $this->line('Skipping seeder creation.');
        }

        if ($this->translationEnabled()) {

            $this->call(
                'generate:translation',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--auth' => $this->option('auth'),
                    '--uuid' => $this->option('uuid'),
                    '--field' => $this->option('field'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--belongs-to-many' => $this->option('belongs-to-many'),
                    '--belongs-to-many-pivot' => $this->option('belongs-to-many-pivot'),
                    '--belongs-to-many-pivot-timestamps' => $this->option('belongs-to-many-pivot-timestamps'),
                    '--has-one' => $this->option('has-one'),
                    '--has-many' => $this->option('has-many'),
                    '--has-many-through' => $this->option('has-many-through'),
                    '--morph-to' => $this->option('morph-to'),
                    '--morph-one' => $this->option('morph-one'),
                    '--morph-many' => $this->option('morph-many'),
                    '--morph-to-many' => $this->option('morph-to-many'),
                    '--morphed-by-many' => $this->option('morphed-by-many'),

                    '--translate' => $this->option('translate'),
                    '--translate-modifier' => $this->option('translate-modifier'),

                    '--translate-field' => $this->option('translate-field'),
                    '--translate-belongs-to' => $this->option('translate-belongs-to'),
                    '--translate-belongs-to-many' => $this->option('translate-belongs-to-many'),
                    '--translate-belongs-to-many-pivot' => $this->option('translate-belongs-to-many-pivot'),
                    '--translate-belongs-to-many-pivot-timestamps' => $this->option('translate-belongs-to-many-pivot-timestamps'),
                    '--translate-has-one' => $this->option('translate-has-one'),
                    '--translate-has-many' => $this->option('translate-has-many'),
                    '--translate-has-many-through' => $this->option('translate-has-many-through'),
                    '--translate-morph-to' => $this->option('translate-morph-to'),
                    '--translate-morph-one' => $this->option('translate-morph-one'),
                    '--translate-morph-many' => $this->option('translate-morph-many'),
                    '--translate-morph-to-many' => $this->option('translate-morph-to-many'),
                    '--translate-morphed-by-many' => $this->option('translate-morphed-by-many'),
                ]
            );

        } else {
            $this->line('Skipping translation creation.');
        }

        if ($this->creatorEnabled()) {

            $this->call(
                'generate:creator',
                [
                    'name' => $name,
                    '--package' => $this->option('package'),
                    '--belongs-to' => $this->option('belongs-to'),
                    '--belongs-to-many' => $this->option('belongs-to-many'),
                    '--has-one' => $this->option('has-one'),
                    '--has-many' => $this->option('has-many'),
                    '--has-many-through' => $this->option('has-many-through'),
                    '--morph-to' => $this->option('morph-to'),
                    '--morph-one' => $this->option('morph-one'),
                    '--morph-many' => $this->option('morph-many'),
                    '--morph-to-many' => $this->option('morph-to-many'),
                    '--morphed-by-many' => $this->option('morphed-by-many'),
                ]
            );

        } else {
            $this->line('Skipping resource creator creation.');
        }

        if ($this->dumpComposerEnabled()) {
            $this->dumpComposer();
        }

        $this->info(sprintf('%s resource created successfully.', $name));

        return true;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, 'The name of the resource.'],
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
            $this->getModelOptions(),
            $this->getNamespaceOptions(),
            $this->getPolicyOptions(),
            $this->getResourceOptions(),
            $this->getSeederOptions(),
            $this->getTranslationOptions()
        );
    }
}
