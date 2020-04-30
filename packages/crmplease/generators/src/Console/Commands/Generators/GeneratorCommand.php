<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Composer;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class GeneratorCommand extends \Illuminate\Console\GeneratorCommand
{
    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * List of Keywords
     * @see https://www.php.net/manual/en/reserved.keywords.php
     * @var array
     */
    protected $keywords = [
        '__halt_compiler',
        'abstract',
        'and',
        'array',
        'as',
        'break',
        'callable',
        'case',
        'catch',
        'class',
        'clone',
        'const',
        'continue',
        'declare',
        'default',
        'die',
        'do',
        'echo',
        'else',
        'elseif',
        'empty',
        'enddeclare',
        'endfor',
        'endforeach',
        'endif',
        'endswitch',
        'endwhile',
        'eval',
        'exit',
        'extends',
        'final',
        'for',
        'foreach',
        'function',
        'global',
        'goto',
        'if',
        'implements',
        'include',
        'include_once',
        'instanceof',
        'insteadof',
        'interface',
        'isset',
        'list',
        'namespace',
        'new',
        'or',
        'print',
        'private',
        'protected',
        'public',
        'require',
        'require_once',
        'return',
        'static',
        'switch',
        'throw',
        'trait',
        'try',
        'unset',
        'use',
        'var',
        'while',
        'xor',
        'yield',
    ];

    /**
     * Predefined Classes
     * @see https://www.php.net/manual/en/reserved.classes.php
     * @var array
     */
    protected $predefined = [
        /**
         * Standard Defined Classes
         */
        'Directory',
        'stdClass',
        '__PHP_Incomplete_Class',

        /**
         * Predefined classes as of PHP 5
         */
        'Exception',
        'ErrorException',
        'php_user_filter',

        /**
         * Closure
         */
        'Closure',

        /**
         * Generator
         */
        'Generator',

        /**
         * Predefined interfaces and classes as of PHP 7
         */
        'ArithmeticError',
        'AssertionError',
        'DivisionByZeroError',
        'Error',
        'Throwable',
        'ParseError',
        'TypeError',

        /**
         * Special classes
         */
        'self',
        'static',
        'parent'
    ];

    /**
     * List of other reserved words
     * @see https://www.php.net/manual/en/reserved.other-reserved-words.php
     * @var array
     */
    protected $reserved = [
        /**
         * Reserved words
         */
        'int',
        'float',
        'bool',
        'string',
        'true',
        'false',
        'null',
        'void',
        'iterable',
        'object',

        /**
         * Soft reserved words
         */
        'resource',
        'mixed',
        'numeric'
    ];

    /**
     * @var string
     */
    protected $rootNamespace = 'App\\';

    /**
     * @var string
     */
    protected $modelNamespace = 'App\\';

    /**
     * @var string
     */
    protected $vendorNamespace = 'Crmplease\\';

    /**
     * @var string
     */
    protected $vendorPath = 'packages/crmplease/';

    /**
     * Create a new controller creator command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param \Illuminate\Support\Composer $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files);

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     * @param string $contents
     * @return string
     */
    protected function makeDirectory($path, $contents = "")
    {
        parent::makeDirectory($path);

        $gitkeep = sprintf('%s/.gitkeep', dirname($path));

        if (!$this->files->exists($gitkeep)) {
            $this->files->put($gitkeep, $contents);
        }

        return $path;
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     * @param string $contents
     * @return string
     */
    protected function makeFile($path, $contents)
    {
        $this->makeDirectory($path);

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
        }

        return $path;
    }

    /**
     * @return boolean
     */
    protected function isPackage()
    {
        return (boolean)$this->option('package');
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        if ($this->isPackage()) {
            return $this->packageNamespace();
        }

        return $this->rootNamespace;
    }

    /**
     * Get the model namespace for the class.
     *
     * @return string
     */
    protected function modelNamespace()
    {
        if ($this->isPackage()) {
            return $this->packageNamespace() . 'Models\\';
        }

        return $this->modelNamespace;
    }

    /**
     * Get the vendor namespace for the package.
     *
     * @return string
     */
    protected function vendorNamespace()
    {
        return $this->vendorNamespace;
    }

    /**
     * Get the package namespace.
     *
     * @return string
     */
    protected function packageNamespace()
    {
        return $this->vendorNamespace() . Str::studly($this->option('package')) . '\\';
    }

    /**
     * @param string $path
     * @return string
     */
    protected function appPath($path = '')
    {
        if ($this->isPackage()) {
            return base_path(
                $this->vendorPath
                . Str::snake($this->option('package'), '-')
                . DIRECTORY_SEPARATOR
                . 'src'
                . ($path ? DIRECTORY_SEPARATOR . $path : $path)
            );
        }

        return app_path($path);
    }

    /**
     * @param string $path
     * @return string
     */
    protected function basePath($path = '')
    {
        if ($this->isPackage()) {
            return base_path(
                $this->vendorPath
                . Str::snake($this->option('package'), '-')
                . ($path ? DIRECTORY_SEPARATOR . $path : $path)
            );
        }

        return base_path($path);
    }

    /**
     * @param $name
     * @return boolean
     */
    protected function isNotAllowed($name)
    {
        if (empty($name)) {
            return true;
        }

        if (in_array(Str::snake($name), $this->keywords)) {
            return true;
        }

        if (in_array(Str::studly($name), $this->predefined)) {
            return true;
        }

        if (in_array(Str::snake($name), $this->reserved)) {
            return true;
        }

        return false;
    }

    /**
     * @param $name
     * @return boolean
     */
    protected function isNotAllowedConfirmed($name)
    {
        return $this->confirm(
            sprintf(
                'Name %s is not allowed to usage as PHP class. Are you sure you want to continue?',
                Str::upper($name)
            )
        );
    }

    /**
     * @param $name
     * @return boolean
     */
    protected function isUncountable($name)
    {
        $parts = explode('_', Str::snake($name));

        $word = Arr::last($parts);

        return in_array(strtolower($word), Pluralizer::$uncountable);
    }

    /**
     * @param $name
     * @return boolean
     */
    protected function isUncountableConfirmed($name)
    {
        return $this->confirm(
            sprintf(
                'Name %s is uncountable, singular and plural forms can be the same. Are you sure you want to continue?',
                Str::upper($name)
            )
        );
    }

    /**
     * @return string
     */
    protected function handleName()
    {
        $name = $this->argument('name') ?: $this->ask(sprintf('Enter the name of %s', Str::lower($this->type) ?: 'resource'));

        if ($this->isNotAllowed($name) && false === $this->isNotAllowedConfirmed($name)) {
            return false;
        }

        if ($this->isUncountable($name) && false === $this->isUncountableConfirmed($name)) {
            return false;
        }

        $this->input->setArgument('name', $name);

        return $name;
    }

    /**
     * @param string|null $default
     * @return string
     */
    protected function handleNamespace($default = null)
    {
        $namespace = $this->option('namespace') ?: $this->ask(sprintf('Enter the namespace of %s', Str::lower($this->type) ?: 'resource'), $default);

        $this->input->setOption('namespace', $namespace);

        return $namespace;
    }

    /**
     * Execute the console command.
     *
     * @return boolean|null
     * @throws FileNotFoundException
     */
    public function handle()
    {
        $name = $this->qualifyClass($this->getClassName());

        $path = $this->getPath($name);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ($this->alreadyExists($this->getClassName())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->success();

        return true;
    }

    /**
     * Get class name.
     *
     * @return string
     */
    protected function getClassName()
    {
        return $this->getNameInput();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return sprintf(__DIR__ . '/stubs/%s.stub', str_replace('_', '.', Str::snake($this->type)));
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
        $rootNamespace = $this->rootNamespace();

        $namespace = $this->getDefaultNamespace(trim($rootNamespace, '\\'));

        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $search = [
            '{{namespace}}',
            '{{class}}',
            '{{class_plural}}',
            '{{class_lower_case}}',
            '{{class_lower_case_plural}}',
            '{{class_snake_case}}',
            '{{class_snake_case_plural}}',
            '{{class_camel_case}}',
            '{{class_camel_case_plural}}',
        ];

        $replace = [
            $namespace,
            Str::studly($class),
            Str::plural(Str::studly($class)),
            lcfirst($class),
            Str::plural(lcfirst($class)),
            Str::snake($class),
            Str::plural(Str::snake($class)),
            Str::camel($class),
            Str::plural(Str::camel($class)),
        ];

        return str_replace($search, $replace, $stub);
    }

    /**
     * @return void
     */
    protected function success()
    {
        if ($this->option('verbose')) {
            $this->info($this->type . ' created successfully.');
        }
    }

    /**
     * @param string $file
     * @param string $section
     * @param string $code
     * @param integer $indent
     * @param string $type
     */
    protected function updateCodeSuggestion($file, $section, $code, $indent = 1, $type = 'comment')
    {
        $path = base_path($file);

        if (empty(trim($code))) {
            return;
        }

        try {

            $contents = $this->files->get($path);

            switch ($type) {
                case 'array_var':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#%s\s*=\s*array\(([^\;]*)\);#mu', preg_quote($section)), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (preg_match(sprintf('#%s\s*=\s*\[([^\;]*)\];#mu', preg_quote($section)), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (empty($search_area)) {
                        $replace = sprintf("%s = [\n%s\n%s];", $section, $code, str_repeat("\t", $indent - 1));
                    } else {
                        $replace = str_replace($search_area, sprintf("%s\n%s", trim($search_area), $code), $search);
                    }

                    break;
                case 'array_return':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#%s[^}]+return\s+array\(([^}]*)\);#mu', preg_quote($section)), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (preg_match(sprintf('#%s[^}]+return\s+\[([^}]*)\];#mu', preg_quote($section)), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (empty($search_area)) {
                        $replace = preg_replace("#\[[^]]*]#mu", sprintf("[\n%s\n%s]", $code, str_repeat("\t", $indent - 1)), $search);
                    } else {
                        $replace = str_replace($search_area, sprintf("%s\n%s", trim($search_area), $code), $search);
                    }
                    break;
                case 'array_assoc_key':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#[\'|"]{1}%s[\'|"]{1}\s*=>\s*array\(([^\(\)]+)#mu', preg_quote($section)), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (preg_match(sprintf('#[\'|"]{1}%s[\'|"]{1}\s*=>\s*\[([^\[\]]+)#mu', preg_quote($section)), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (empty($search_area)) {
                        $search_area = $contents;
                        $replace = sprintf("%s\n%s", $code, $search);
                    } else {
                        $replace = str_replace($search_area, sprintf("%s\n%s%s", trim($code), str_repeat("\t", $indent), $search_area), $search);
                    }

                    break;
                case 'class_phpdoc':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#(/\*\*[^/]+%s[^/]+)\s+\*\s+@package\s+\w+#mu', preg_quote($section)), $contents, $matches)) {
                        $search = $matches[0];
                        $search_area = isset($matches[1]) ? $matches[1] : "";
                    }

                    $replace = str_replace($search_area, sprintf("%s%s\n", $search_area, $code), $search);

                    if (empty($search_area)) {
                        $search = false;
                        $search_area = $contents;
                    }

                    break;
                case 'class_use':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#namespace\s+[^;]+;[^/]+(use\s+[^;]+;)*#mu'), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (empty($search_area)) {
                        $search_area = $contents;
                        $replace = sprintf("%s\n%s", $search, $code);
                    } else {
                        $replace = str_replace($search_area, sprintf("%s\n%s", $search_area, $code), $search);
                    }

                    break;
                case 'class_extends':
                    $search = false;

                    $search_area = $contents;

                    if (preg_match(sprintf('#(%s\s.*\sextends\s.*\s{)#mu', preg_quote($section)), $contents, $matches)) {
                        $search = $matches[0];
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    $replace = $code;

                    break;
                /**
                 * ToDo
                 */
                case 'class_traits':
                    $search = false;

                    $search_area = $contents;

                    if (preg_match(sprintf('#class\s.*{.*\%s\s([^\;]*);#mu', preg_quote($section)), $contents, $matches)) {
                        $search = $matches[0];
                        $search_area = trim($matches[1]);
                    }

                    if (empty($search_area)) {
                        $replace = sprintf("use %s;", $code);
                    } else {
                        $replace = str_replace($search_area, sprintf("%s, %s", $search_area, $code), $search);
                    }

                    break;
                case 'class_property':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#class[^{]+{([^}]+use\s+[^;]+;)?#mu'), $contents, $matches)) {
                        $search = trim($matches[0]);
                    }

                    $replace = sprintf("%s\n%s", $search, $code);

                    break;
                case 'func_phpdoc':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#(/\*\*[^/]+)\s+\*/[^/]+function\s+%s[\s]*\(#mu', preg_quote($section)), $contents, $matches)) {
                        $search = $matches[0];
                        $search_area = isset($matches[1]) ? $matches[1] : "";
                    }

                    if (preg_match(sprintf('#(/\*\*[^/]+)\s+\*\s+@return\s+[\s\S]+function\s+%s[\s]*\(#mu', preg_quote($section)), $contents, $matches)) {
                        $search = $matches[0];
                        $search_area = isset($matches[1]) ? $matches[1] : "";
                    }

                    if (empty($search_area)) {
                        $search = false;
                        $search_area = $contents;
                    } else {
                        $replace = str_replace($search_area, sprintf("%s%s\n%s", $search_area, sprintf(" %s", trim($code)), str_repeat("\t", $indent)), $search);
                    }

                    break;
                case 'func_args':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#function\s+%s\(([^)]*)\)#mu', preg_quote($section)), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (empty($search_area)) {
                        $replace = preg_replace("#\([^)]*\)#mu", sprintf("(%s)", trim($code)), $search);
                    } else {
                        $replace = str_replace($search_area, sprintf("%s,\n%s", $search_area, $code), $search);
                    }

                    break;
                case 'func_body':
                    $search = false;
                    $search_area = $contents;

                    if (preg_match(sprintf('#function\s+%s\([^)]*\)[^{]*{([^}]*)}#mu', preg_quote($section)), $contents, $matches)) {
                        $search = trim($matches[0]);
                        $search_area = isset($matches[1]) ? trim($matches[1]) : "";
                    }

                    if (empty($search_area)) {
                        $search = false;
                        $search_area = $contents;
                    } else {
                        $replace = str_replace($search_area, sprintf("%s\n%s%s", trim($code), str_repeat("\t", $indent), $search_area), $search);
                    }
                    break;
                default:
                    $search = sprintf("// ...%s", $section);

                    $search_area = $contents;

                    $lines = explode("\n", $code);

                    foreach ($lines as $number => &$line) {
                        if ($number > 0) {
                            $line = sprintf('%s%s', str_repeat("\t", $indent), $line);
                        }
                    }

                    $replace = sprintf("%s\n%s%s", implode("\n", $lines), str_repeat("\t", $indent), $search);

                    break;
            }

            if (false === $position = strpos($search_area, trim($code))) {

                if (false === $search || false === $position = strpos($contents, $search)) {
                    $this->info(sprintf("Add the following lines to %s file at '%s' section:", $file, $section));
                    $this->comment($code);
                } else {

                    $contents = str_replace($search, $replace, $contents);

                    $this->files->put($path, $contents);

                    if ($this->option('verbose')) {
                        $this->info(sprintf('%s file updated successfully.', $file));
                    }
                }

            } else {
                if ($this->option('verbose')) {
                    $this->info(sprintf('Code is already present at %s file.', $file));
                }
            }
        } catch (FileNotFoundException $exception) {
            $this->error(sprintf('%s file is not exists', $file));
        }
    }

    /**
     * @return void
     */
    protected function dumpComposer()
    {
        $this->composer->dumpAutoloads();
        $this->composer->dumpOptimized();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getGeneratorOptions()
    {
        return [
            ['package', null, InputOption::VALUE_OPTIONAL, 'Vendor package name.'],
            ['force', 'f', InputOption::VALUE_NONE, 'Generate with no prompt.'],
        ];
    }
}
