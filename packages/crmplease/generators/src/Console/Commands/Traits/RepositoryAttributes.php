<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Symfony\Component\Console\Input\InputOption;

trait RepositoryAttributes
{
    /**
     * @return integer
     */
    protected function isEloquent()
    {
        return (boolean)$this->option('eloquent');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getRepositoryOptions()
    {
        return [
            ['eloquent', 'e', InputOption::VALUE_NONE, 'Create an eloquent implementation of repository interface'],
        ];
    }
}
