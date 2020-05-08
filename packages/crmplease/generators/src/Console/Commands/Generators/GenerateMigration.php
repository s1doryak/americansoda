<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class GenerateMigration extends GeneratorCommand implements HasModelAttributes
{
    use ModelAttributes;

    /**
     * Migration name hash length
     */
    const HASH_LENGTH = 8;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate migration';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migration';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('update')) {
            $this->type = 'MigrationUpdate';
        }

        return sprintf(__DIR__ . '/stubs/%s.stub', str_replace('_', '.', Str::snake($this->type)));
    }

    /**
     * @return string
     */
    protected function dumpMigrationHash()
    {
        $name = Str::plural(Str::snake($this->argument('name')));

        $date = date('Y_m_d_His');

        if ($this->option('update')) {
            $template = '%s_update_%s_table';
        } else {
            $template = '%s_create_%s_table';
        }

        return '1' . substr(md5(sprintf($template, $date, $name)), -1 * self::HASH_LENGTH);
    }

    /**
     * @return string
     */
    protected function dumpMigrationId()
    {
        if ($this->isUuidResource()) {
            return "\t\t\t\$table->uuid('id')->primary();";
        }

        return "\t\t\t\$table->bigIncrements('id');";
    }

    /**
     * Get class name.
     *
     * @return string
     */
    protected function getClassName()
    {
        return Str::plural(Str::snake($this->argument('name')));
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::plural(Str::snake($this->argument('name')));

        $date = date('Y_m_d_His');

        if ($this->option('update')) {
            $template = '%s/database/migrations/%s_update_%s_table_%s.php';

            $hash = '1' . substr(md5(sprintf('%s_update_%s_table', $date, $name)), -1 * self::HASH_LENGTH);

            return sprintf(
                $template, $this->basePath(), $date, $name, $hash);
        } else {
            $template = '%s/database/migrations/%s_create_%s_table.php';

            return sprintf($template, $this->basePath(), $date, $name);
        }
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

        $fields = $this->getMigrationFields();

        $fks = $this->getMigrationFks();

        $morphTo = $this->getMorphTo();

        $search = [
            '{{migration_hash}}',
            '{{migration_id}}',
            '{{migration_fields}}',
            '{{migration_fks}}',
            '{{migration_morph_to}}',
        ];

        $replace = [
            $this->dumpMigrationHash(),
            $this->dumpMigrationId(),
            $this->dumpMigrationFields($fields),
            $this->dumpMigrationFks($fks),
            $this->dumpMigrationMorphTo($morphTo)
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
            [
                ['update', '', InputOption::VALUE_NONE, 'Update existing table'],
            ]
        );
    }
}
