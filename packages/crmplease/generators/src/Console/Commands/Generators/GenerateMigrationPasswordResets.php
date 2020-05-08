<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Illuminate\Support\Str;

class GenerateMigrationPasswordResets extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:migration:password_resets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate password resets table migration';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'MigrationPasswordResets';

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
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
		$name = Str::plural(Str::snake($this->argument('name')));

		$template = '%s/database/migrations/%s_create_%s_password_resets_table.php';

		return sprintf($template, $this->basePath(), date('Y_m_d_His'), $name);
    }
}
