<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateNamespace extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:namespace';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate namespace';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Namespace';

    /**
     * Namespace resource directories.
     *
     * @var array
     */
    protected $namespaceResourceDirectories = [
        'app/DataTables/{{namespace_studly_case}}',
        'app/Events/{{namespace_studly_case}}',
        'app/Forms/{{namespace_studly_case}}',
        'app/Http/Controllers/{{namespace_studly_case}}',
        'app/Http/Middleware/{{namespace_studly_case}}',
        'app/Listeners/{{namespace_studly_case}}',
        'app/Notifications/{{namespace_studly_case}}',
        'app/Transformers/{{namespace_studly_case}}',
        'resources/views/{{namespace_snake_case}}',
        'resources/views/{{namespace_snake_case}}/resources',
    ];

    /**
     * Namespace resource files.
     *
     * @var array
     */
    protected $namespaceResourceFiles = [
        'app/Http/Controllers/{{namespace_studly_case}}/Auth/ForgotPasswordController.php' => 'controllers/auth/forgot_password_controller',
        'app/Http/Controllers/{{namespace_studly_case}}/Auth/LoginController.php' => 'controllers/auth/login_controller',
        'app/Http/Controllers/{{namespace_studly_case}}/Auth/RegisterController.php' => 'controllers/auth/register_controller',
        'app/Http/Controllers/{{namespace_studly_case}}/Auth/ResetPasswordController.php' => 'controllers/auth/reset_password_controller',
        'app/Http/Controllers/{{namespace_studly_case}}/Auth/VerificationController.php' => 'controllers/auth/verification_controller',
        'app/Http/Controllers/{{namespace_studly_case}}/HomeController.php' => 'controllers/home_controller',
        'app/Http/Middleware/{{namespace_studly_case}}/Authenticate.php' => 'middleware/authenticate',
        'resources/views/{{namespace_snake_case}}/home.blade.php' => 'views/home',
        'resources/views/{{namespace_snake_case}}/master.blade.php' => 'views/master',
        'resources/views/{{namespace_snake_case}}/modal.blade.php' => 'views/modal',
        'resources/views/{{namespace_snake_case}}/actions/create.blade.php' => 'views/actions/create',
        'resources/views/{{namespace_snake_case}}/actions/index.blade.php' => 'views/actions/index',
        'resources/views/{{namespace_snake_case}}/actions/show.blade.php' => 'views/actions/show',
        'resources/views/{{namespace_snake_case}}/auth/login.blade.php' => 'views/auth/login',
        'resources/views/{{namespace_snake_case}}/auth/register.blade.php' => 'views/auth/register',
        'resources/views/{{namespace_snake_case}}/auth/passwords/email.blade.php' => 'views/auth/passwords/email',
        'resources/views/{{namespace_snake_case}}/auth/passwords/reset.blade.php' => 'views/auth/passwords/reset',
        'routes/{{namespace_snake_case}}.php' => 'routes',
    ];

    /**
     * Namespace plain directories.
     *
     * @var array
     */
    protected $namespacePlainDirectories = [
        'app/Events/{{namespace_studly_case}}',
        'app/Http/Controllers/{{namespace_studly_case}}',
        'app/Http/Middleware/{{namespace_studly_case}}/Authenticate.php' => 'middleware/authenticate',
        'app/Listeners/{{namespace_studly_case}}',
    ];

    /**
     * Namespace plain files.
     *
     * @var array
     */
    protected $namespacePlainFiles = [
        'routes/{{namespace_snake_case}}.php' => 'routes.plain',
    ];

    /**
     * @param boolean $plain
     * @return array
     */
    public function getNamespaceDirectories($plain = false)
    {
        return $this->{sprintf('namespace%sDirectories', $plain ? 'Plain' : 'Resource')};
    }

    /**
     * @param boolean $plain
     * @return array
     */
    public function getNamespaceFiles($plain = false)
    {
        return $this->{sprintf('namespace%sFiles', $plain ? 'Plain' : 'Resource')};
    }

    /**
     * Execute the console command.
     *
     * @return boolean|null|void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if (false === $name = $this->handleName()) {
            return false;
        }

        $plain = $this->option('plain');

        $suffix = $this->option('suffix');

        if ($suffix) {
            $search = [
                '{{namespace_studly_case}}',
                '{{namespace_camel_case}}',
                '{{namespace_snake_case}}',
            ];

            $replace = [
                sprintf('%s/%s', Str::studly($name), Str::studly($suffix)),
                sprintf('%s/%s', Str::camel($name), Str::camel($suffix)),
                sprintf('%s/%s', Str::snake($name), Str::snake($suffix)),
            ];
        } else {
            $search = [
                '{{namespace_studly_case}}',
                '{{namespace_camel_case}}',
                '{{namespace_snake_case}}',
            ];

            $replace = [
                Str::studly($name),
                Str::camel($name),
                Str::snake($name)
            ];
        }

        /**
         * Make directories
         */
        foreach ($this->getNamespaceDirectories($plain) as $directory) {

            $path = $this->basePath(str_replace($search, $replace, $directory));

            $this->makeDirectory($path);
        }

        /**
         * Make files
         */
        foreach ($this->getNamespaceFiles($plain) as $file => $type) {

            $path = $this->basePath(str_replace($search, $replace, $file));

            $this->makeFile($path, $this->buildClass($name, $type));
        }

        $this->success();
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
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub($type = '')
    {
        return sprintf(__DIR__ . '/stubs/namespace/%s.stub', $type);
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
        $name = $this->getClassName();

        $suffix = $this->option('suffix');

        if ($suffix) {
            $search = [
                '{{namespace_studly_case}}',
                '{{namespace_camel_case}}',
                '{{namespace_snake_case}}',
            ];

            $replace = [
                sprintf('%s/%s', Str::studly($name), Str::studly($suffix)),
                sprintf('%s/%s', Str::camel($name), Str::camel($suffix)),
                sprintf('%s/%s', Str::snake($name), Str::snake($suffix)),
            ];
        } else {
            $search = [
                '{{namespace_studly_case}}',
                '{{namespace_camel_case}}',
                '{{namespace_snake_case}}',
            ];

            $replace = [
                Str::studly($name),
                Str::camel($name),
                Str::snake($name)
            ];
        }

        return str_replace($search, $replace, $stub);
    }

    /**
     * Display success message to console.
     */
    protected function success()
    {
        parent::success();

        $name = $this->getClassName();

        $plain = $this->option('plain');

        $suffix = $this->option('suffix');

        if ($suffix) {
            $camel_name = sprintf('%s/%s', Str::camel($name), Str::camel($suffix));
            $snake_name = sprintf('%s/%s', Str::snake($name), Str::snake($suffix));
            $studly_name = sprintf('%s/%s', Str::studly($name), Str::studly($suffix));
        } else {
            $camel_name = Str::camel($name);
            $snake_name = Str::snake($name);
            $studly_name = Str::studly($name);
        }

        $this->updateCodeSuggestion(
            'app/Http/Kernel.php',
            '$middlewareGroups',
            sprintf(
                implode("\n", [
                    "'%s' => [",
                    "\t// \App\Http\Middleware\%s\Authenticate::class,",
                    "],",
                    ""
                ]),
                $camel_name,
                str_replace('/', '\\', $studly_name)
            ),
            2
        );

        $this->updateCodeSuggestion(
            'config/namespaces.php',
            'php',
            sprintf(
                implode("\n", [
                    "'%s' => 'App\Http\Controllers\%s',",
                ]),
                $camel_name,
                str_replace('/', '\\', $studly_name)
            ),
            1,
            'array_return'
        );

        $this->updateCodeSuggestion(
            'app/Providers/RouteServiceProvider.php',
            'mapRoutes()',
            sprintf(
                implode("\n", [
                    "/**",
                    " * Define the \"%s\" routes for the application.",
                    " *",
                    " * @return void",
                    " */",
                    "protected function map%sRoutes()",
                    "{",
                    "\tRoute::middleware('%s')",
                    "\t\t->namespace(config('namespaces.%s'))",
                    "\t\t->group(base_path('routes/%s.php'));",
                    "}",
                    ""
                ]),
                $camel_name,
                str_replace('/', '', $studly_name),
                $camel_name,
                $camel_name,
                $camel_name
            )

        );

        $this->updateCodeSuggestion(
            'app/Providers/RouteServiceProvider.php',
            '$this->mapRoutes()',
            sprintf(
                "\$this->map%sRoutes();",
                str_replace('/', '', $studly_name)
            ),
            2
        );

        if ($plain === false) {
            $this->updateCodeSuggestion(
                'app/Providers/AppServiceProvider.php',
                'views',
                sprintf(
                    "\$this->loadViewsFrom(resource_path('views/%s'), '%s');",
                    $camel_name,
                    $camel_name
                ),
                2
            );
        }

        $this->info(sprintf('%s namespace created successfully.', $name));

        return true;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getNamespaceOptions()
    {
        return [
            ['suffix', null, InputOption::VALUE_OPTIONAL, 'Useful for API versions.'],
            ['plain', null, InputOption::VALUE_NONE, 'No resource namespace. Useful for external web hooks.'],
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, 'The name of the namespace.'],
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
            $this->getNamespaceOptions()
        );
    }
}
