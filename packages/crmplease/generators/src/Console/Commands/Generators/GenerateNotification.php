<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNotificationAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasTranslatableAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\NotificationAttributes;
use Crmplease\Generators\Console\Commands\Traits\TranslatableAttributes;
use Illuminate\Support\Str;

class GenerateNotification extends GeneratorCommand implements HasNamespaceAttributes, HasNotificationAttributes, HasTranslatableAttributes
{
    use NamespaceAttributes, NotificationAttributes, TranslatableAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate notification';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Notification';

    /**
     * Notifications directories.
     *
     * @var array
     */
    protected $notificationDirectories = [
        'resources/lang/{{locale}}/notifications',
    ];

    /**
     * Notifications files.
     *
     * @var array
     */
    protected $notificationFiles = [
        'resources/lang/{{locale}}/notifications/{{notification_snake_case}}.php' => 'notification',
    ];

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = $this->option('namespace') ?: self::DEFAULT_NAMESPACE;

        return sprintf('%s\Notifications\%s', trim($rootNamespace, '\\'), Str::studly($namespace));
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $template = '%s/%s.php';

        return sprintf($template, $this->appPath(), str_replace('\\', '/', $name));
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @param string $locale
     * @return string
     */
    protected function replaceClass($stub, $name, $locale = '')
    {
        $stub = parent::replaceClass($stub, $name);

        $channels = $this->getNotificationChannels();

        $notification = $this->getNameInput();

        $search = [
            '{{notification_channels}}',
            '{{notification_subject}}',
            '{{notification_message}}',
            '{{notification_subject_translation}}',
            '{{notification_message_translation}}',
        ];

        $replace = [
            $this->dumpNotificationChannels($channels),
            $this->dumpNotificationSubject($notification),
            $this->dumpNotificationMessage($notification),
            $this->translateOption('subject', $locale),
            $this->translateOption('message', $locale),
        ];

        return str_replace($search, $replace, $stub);
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @param string $locale
     * @param string $type
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name, $locale = '', $type = '')
    {
        $stub = $this->files->get($this->getStub($locale, $type, Str::snake($name)));

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name, $locale);
    }

    /**
     * Get the stub file for the generator.
     *
     * @param string $locale
     * @param string $type
     * @param string $name
     * @return string
     */
    protected function getStub($locale = '', $type = '', $name = '')
    {
        if ($locale && $name) {
            $stub = sprintf(__DIR__ . '/stubs/notification/%s/%s.stub', $locale, $name);

            if ($this->files->exists($stub)) {
                return $stub;
            }

            $stub = sprintf(__DIR__ . '/stubs/notification/%s.stub', $name);

            if ($this->files->exists($stub)) {
                return $stub;
            }
        }

        if ($locale && $type) {
            $stub = sprintf(__DIR__ . '/stubs/notification/%s/%s.stub', $locale, $type);

            if ($this->files->exists($stub)) {
                return $stub;
            }
        }

        if ($type) {
            $stub = sprintf(__DIR__ . '/stubs/notification/%s.stub', $type);

            if ($this->files->exists($stub)) {
                return $stub;
            }
        }

        return parent::getStub();
    }

    /**
     * @return array
     */
    public function getNamespaceDirectories()
    {
        return $this->notificationDirectories;
    }

    /**
     * @return array
     */
    public function getNamespaceFiles()
    {
        return $this->notificationFiles;
    }

    /**
     * @return array
     */
    public function getTranslatableAttributes()
    {
        return [
            'subject',
            'message'
        ];
    }

    public function handle()
    {
        if (false === $name = $this->handleName()) {
            return false;
        }

        $namespace = $this->handleNamespace(self::DEFAULT_NAMESPACE);

        foreach ($this->getLocales() as $locale) {

            $search = [
                '{{locale}}',
                '{{namespace_studly_case}}',
                '{{namespace_camel_case}}',
                '{{namespace_snake_case}}',
                '{{notification_studly_case}}',
                '{{notification_camel_case}}',
                '{{notification_snake_case}}',
            ];

            $replace = [
                Str::lower($locale),
                Str::studly($namespace),
                Str::camel($namespace),
                Str::snake($namespace),
                Str::studly($name),
                Str::camel($name),
                Str::snake($name)
            ];

            /**
             * Make directories
             */
            foreach ($this->getNamespaceDirectories() as $directory) {

                $path = $this->basePath(str_replace($search, $replace, $directory));

                $this->makeDirectory($path);
            }

            /**
             * Make files
             */
            foreach ($this->getNamespaceFiles() as $file => $type) {

                $path = $this->basePath(str_replace($search, $replace, $file));

                $this->makeFile($path, $this->buildClass($name, $locale, $type));
            }
        }

        return parent::handle();
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
            $this->getNamespaceOptions(),
            $this->getNotificationOptions(),
            $this->getTranslatableOptions()
        );
    }
}
