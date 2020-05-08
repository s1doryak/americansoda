<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Illuminate\Support\Str;

class GenerateDataTable extends GeneratorCommand implements HasModelAttributes, HasNamespaceAttributes
{
    use ModelAttributes, NamespaceAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:datatable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate datatable';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'DataTable';

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = $this->option('namespace') ?: self::DEFAULT_NAMESPACE;

        return sprintf('%s\DataTables\%s', trim($rootNamespace, '\\'), Str::studly($namespace));
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

        $template = Str::endsWith('DataTable', $name) ? '%s/%s.php' : '%s/%sDataTable.php';

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

        $search = [
            '{{datatables_columns}}',
            '{{datatables_raw_columns}}',
            '{{datatables_aggregate_columns}}',
            '{{datatables_filterable_columns}}'
        ];

        $replace = [
            $this->dumpDatatablesColumns($this->getDatatablesColumns()),
            $this->dumpDatatablesRawColumns($this->getDatatablesRawColumns()),
            $this->dumpDatatablesAggregateColumns($this->getDatatablesAggregateColumns()),
            $this->dumpDatatablesFilterableColumns($this->getDatatablesFilterableColumns())
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
