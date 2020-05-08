<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\TranslateAttributes;
use Illuminate\Support\Str;

class GenerateTranslation extends GeneratorCommand implements HasModelAttributes
{
    use ModelAttributes, TranslateAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:translation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate translation';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Translation';

    /**
     * @var array
     */
    protected $defaultLabels = [
        'email' => [
            'en' => 'E-mail',
            'ru' => 'Эл. почта',
        ],
        'email_verified_at' => [
            'en' => 'Verified At',
            'ru' => 'Подтвержден'
        ],
        'password' => [
            'en' => 'Password',
            'ru' => 'Пароль'
        ],
    ];

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @param string $locale
     * @return string
     */
    protected function getPath($name, $locale = '')
    {
        $name = Str::snake($this->getClassName());

        $locale = $locale ?: config('app.fallback_locale');

        return sprintf('%s/%s/models/%s.php', $this->basePath('resources/lang'), $locale, $name);
    }

    /**
     * Build the class with the given name.
     *
     * @param string $locale
     * @param string $modifier
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($locale, $modifier = '')
    {
        $stub = $this->files->get($this->getStub($locale, $modifier));

        return $this->replaceClass($stub, $locale, $modifier);
    }

    /**
     * Get the stub file for the generator.
     *
     * @param string $locale
     * @param string $modifier
     * @return string
     */
    protected function getStub($locale = '', $modifier = '')
    {
        $modifiedStub = sprintf(__DIR__ . '/stubs/translation/%s/%s.stub', $locale, $modifier);

        if ($this->files->exists($modifiedStub)) {
            return $modifiedStub;
        }

        $stud = sprintf(__DIR__ . '/stubs/translation/%s.stub', $locale);

        if ($this->files->exists($stud)) {
            return $stud;
        }

        return __DIR__ . '/stubs/translation.stub';
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $locale
     * @param string $modifier
     * @return string
     */
    protected function replaceClass($stub, $locale, $modifier = '')
    {
        $stub = parent::replaceClass($stub, $locale);

        $labels = $this->getTranslateLabels($locale, $modifier);

        $translation_label = Str::singular($this->getTranslationFieldLabel($this->getClassName(), $locale, $modifier));

        $translation_label_plural = Str::plural($this->getTranslationFieldLabel($this->getClassName(), $locale, $modifier));

        $search = [
            '{{translation_label}}',
            '{{translation_label_plural}}',
            '{{translation_label_lower_case}}',
            '{{translation_label_plural_lower_case}}',

            '{{translation_fields}}',
            '{{translation_relations}}',
            '{{translation_placeholders}}',

            '{{translation_label:0}}',
            '{{translation_label:1}}',
            '{{translation_label:2}}',
            '{{translation_label:3}}',
            '{{translation_label:4}}',
            '{{translation_label:5}}',

            '{{translation_label_lower_case:0}}',
            '{{translation_label_lower_case:1}}',
            '{{translation_label_lower_case:2}}',
            '{{translation_label_lower_case:3}}',
            '{{translation_label_lower_case:4}}',
            '{{translation_label_lower_case:5}}',
        ];

        $replace = [
            $this->dumpTranslateLabels($labels, 0, $translation_label),
            $this->dumpTranslateLabels($labels, 1, $translation_label_plural),
            mb_convert_case($this->dumpTranslateLabels($labels, 0, $translation_label), MB_CASE_LOWER),
            mb_convert_case($this->dumpTranslateLabels($labels, 1, $translation_label_plural), MB_CASE_LOWER),

            $this->dumpTranslationFields($this->getTranslationFields(), $locale, $modifier),
            $this->dumpTranslationRelations($this->getTranslationRelations(), $locale, $modifier, 0),
            $this->dumpTranslationPlaceholders($this->getTranslationPlaceholders(), $locale, $modifier, 1),

            $this->dumpTranslateLabels($labels, 0, $translation_label),
            $this->dumpTranslateLabels($labels, 1, $translation_label_plural),
            $this->dumpTranslateLabels($labels, 2, $translation_label),
            $this->dumpTranslateLabels($labels, 3, $translation_label),
            $this->dumpTranslateLabels($labels, 4, $translation_label),
            $this->dumpTranslateLabels($labels, 5, $translation_label),

            mb_convert_case($this->dumpTranslateLabels($labels, 0, $translation_label), MB_CASE_LOWER),
            mb_convert_case($this->dumpTranslateLabels($labels, 1, $translation_label_plural), MB_CASE_LOWER),
            mb_convert_case($this->dumpTranslateLabels($labels, 2, $translation_label), MB_CASE_LOWER),
            mb_convert_case($this->dumpTranslateLabels($labels, 3, $translation_label), MB_CASE_LOWER),
            mb_convert_case($this->dumpTranslateLabels($labels, 4, $translation_label), MB_CASE_LOWER),
            mb_convert_case($this->dumpTranslateLabels($labels, 5, $translation_label), MB_CASE_LOWER),
        ];

        return str_replace($search, $replace, $stub);
    }

    /**
     * @return boolean|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name = $this->getClassName();

        $modifiers = $this->getTranslateModifiers();

        foreach ($this->getTranslate() as $locale => $labels) {

            $path = $this->getPath($name, $locale);

            $modifier = $modifiers->has($locale) ? $modifiers->get($locale) : '';

            $this->makeFile($path, $this->buildClass($locale, $modifier));

            if ($this->option('verbose')) {
                $this->info(sprintf('Translation file «%s» created successfully.', $locale));
            }

        }
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
            $this->getTranslationOptions()
        );
    }
}
