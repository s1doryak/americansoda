<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Illuminate\Support\Str;

class GenerateForm extends GeneratorCommand implements HasModelAttributes, HasNamespaceAttributes
{
    use ModelAttributes, NamespaceAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate form';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Form';

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = $this->option('namespace') ?: self::DEFAULT_NAMESPACE;

        return sprintf('%s\Forms\%s', trim($rootNamespace, '\\'), Str::studly($namespace));
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::singular(Str::replaceFirst($this->rootNamespace(), '', $name));

        $template = Str::endsWith('Form', $name) ? '%s/%s.php' : '%s/%sForm.php';

        return sprintf($template, $this->appPath(), str_replace('\\', '/', $name));
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
        $stub = parent::replaceClass($stub, $name);

        $formFields = $this->getFormFields();

        $search = [
            '{{form_fields}}',
            '{{validation_rules}}',
            '{{store_validation_rules}}',
            '{{update_validation_rules}}',
        ];

        $replace = [
            $this->dumpFormFields($formFields),
            $this->dumpValidationRules($formFields),
            $this->dumpStoreValidationRules($formFields),
            $this->dumpUpdateValidationRules($formFields),
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
}
