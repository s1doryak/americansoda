<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Trait TranslatableAttributes
 * @package Crmplease\Generators\Console\Commands\Traits
 */
trait TranslatableAttributes
{
    /**
     * @return string
     */
    protected function getDefaultLocale()
    {
        return config('app.fallback_locale', self::DEFAULT_LOCALE);
    }

    /**
     * @return array
     */
    protected function getLocales()
    {
        $locales = array_keys(config('locales', []));

        $default = $this->getDefaultLocale();

        return $locales + [$default];
    }

    /**
     * @param string $option
     * @param string $locale
     * @return string|null
     */
    protected function translateOption($option, $locale)
    {
        $locale = $locale ?: $this->getDefaultLocale();

        if ($this->option(sprintf('translate-%s-%s', $option, $locale))) {
            return $this->option(sprintf('translate-%s-%s', $option, $locale));
        }

        return $this->option($option);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getTranslatableOptions()
    {
        $options = [];

        foreach ($this->getLocales() as $locale) {
            foreach ($this->getTranslatableAttributes() as $option) {
                $options[] = [
                    sprintf('translate-%s-%s', $option, $locale),
                    null,
                    InputOption::VALUE_OPTIONAL,
                    sprintf('%s %s translation.', Str::ucfirst(str_replace('-', ' ', $option)), Str::upper($locale))
                ];
            }
        }

        return $options;
    }
}
