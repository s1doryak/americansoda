<?php

namespace Crmplease\Generators\Console\Commands\Contracts;

interface HasTranslatableAttributes
{
    const DEFAULT_LOCALE = 'en';

    /**
     * @return array
     */
    public function getTranslatableAttributes();
}
