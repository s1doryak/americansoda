<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Illuminate\Support\Str;

class GenerateTransformer extends GeneratorCommand implements HasModelAttributes, HasNamespaceAttributes
{
    use ModelAttributes, NamespaceAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:transformer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate transformer';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Transformer';

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = $this->option('namespace') ?: self::DEFAULT_NAMESPACE;

        return sprintf('%s\Transformers\%s', trim($rootNamespace, '\\'), Str::studly($namespace));
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

        $template = Str::endsWith('Transformer', $name) ? '%s/%s.php' : '%s/%sTransformer.php';

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

        $fields = $this->getTransformerFields();
        $relations = $this->getBelongsTo();
        $manyRelations = $this->getBelongsToMany();

        $search = [
            '{{transformer_request_fields}}',
            '{{transformer_request_relations}}',
            '{{transformer_request_many_relations}}',
            '{{transformer_to_array_fields}}',
            '{{transformer_to_array_relations}}',
            '{{transformer_to_array_many_relations}}',
        ];

        $replace = [
            $this->dumpTransformerRequestFields($fields),
            $this->dumpTransformerRequestRelations($relations),
            $this->dumpTransformerRequestManyRelations($manyRelations),
            $this->dumpTransformerToArrayFields($fields),
            $this->dumpTransformerToArrayRelations($relations),
            $this->dumpTransformerToArrayManyRelations($manyRelations),
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
