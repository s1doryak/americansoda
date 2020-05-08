<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Symfony\Component\Console\Input\InputOption;

trait NamespaceAttributes
{
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getNamespaceOptions()
    {
        return [
            ['namespace', null, InputOption::VALUE_REQUIRED, 'Namespace.'],
        ];
    }
}
