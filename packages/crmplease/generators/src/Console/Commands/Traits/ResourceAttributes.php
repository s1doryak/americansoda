<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Symfony\Component\Console\Input\InputOption;

trait ResourceAttributes
{
    /**
     * @return boolean
     */
    protected function modelEnabled()
    {
        if ($this->option('skip-model')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create model?', true);
    }

    /**
     * @return boolean
     */
    protected function repositoryEnabled()
    {
        if ($this->option('skip-repository')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create repository?', true);
    }

    /**
     * @return boolean
     */
    protected function policyEnabled()
    {
        if ($this->option('skip-policy')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create policy?', true);
    }

    /**
     * @return boolean
     */
    protected function migrationEnabled()
    {
        if ($this->option('skip-migration')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create migration?', true);
    }

    /**
     * @return boolean
     */
    protected function controllerEnabled()
    {
        if ($this->option('skip-controller')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create controller?', true);
    }

    /**
     * @return boolean
     */
    protected function formEnabled()
    {
        if ($this->option('skip-form')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create form?', true);
    }

    /**
     * @return boolean
     */
    protected function transformerEnabled()
    {
        if ($this->option('skip-transformer')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create transformer?', true);
    }

    /**
     * @return boolean
     */
    protected function datatableEnabled()
    {
        if ($this->option('skip-datatable')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create datatable?', true);
    }

    /**
     * @return boolean
     */
    protected function factoryEnabled()
    {
        if ($this->option('skip-factory')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create factory?', true);
    }

    /**
     * @return boolean
     */
    protected function seederEnabled()
    {
        if ($this->option('skip-seeder')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create seeder?', true);
    }

    /**
     * @return boolean
     */
    protected function translationEnabled()
    {
        if ($this->option('skip-translation')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create translation?', true);
    }

    /**
     * @return boolean
     */
    protected function creatorEnabled()
    {
        if ($this->option('skip-creator')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create creator?', true);
    }

    /**
     * @return boolean
     */
    protected function dumpComposerEnabled()
    {
        if ($this->option('skip-dump-composer')) {
            return false;
        }

        return $this->option('force') || $this->confirm('Create creator?', true);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getResourceOptions()
    {
        return [
            ['skip-model', null, InputOption::VALUE_NONE, 'Skip model creation.'],
            ['skip-repository', null, InputOption::VALUE_NONE, 'Skip repository creation.'],
            ['skip-policy', null, InputOption::VALUE_NONE, 'Skip policy creation.'],
            ['skip-migration', null, InputOption::VALUE_NONE, 'Skip migration creation.'],
            ['skip-controller', null, InputOption::VALUE_NONE, 'Skip controller creation.'],
            ['skip-form', null, InputOption::VALUE_NONE, 'Skip form creation.'],
            ['skip-transformer', null, InputOption::VALUE_NONE, 'Skip transformer creation.'],
            ['skip-datatable', null, InputOption::VALUE_NONE, 'Skip datatable creation.'],
            ['skip-factory', null, InputOption::VALUE_NONE, 'Skip factory creation.'],
            ['skip-seeder', null, InputOption::VALUE_NONE, 'Skip seeder creation.'],
            ['skip-translation', null, InputOption::VALUE_NONE, 'Skip translation creation.'],
            ['skip-creator', null, InputOption::VALUE_NONE, 'Skip creator creation.'],
            ['skip-dump-composer', null, InputOption::VALUE_NONE, 'Skip composer dump after creation.'],
        ];
    }
}
