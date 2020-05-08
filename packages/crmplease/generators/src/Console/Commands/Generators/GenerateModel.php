<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Illuminate\Support\Str;

class GenerateModel extends GeneratorCommand implements HasModelAttributes, HasNamespaceAttributes
{
    use ModelAttributes, NamespaceAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->isAuthResource()) {
            $this->type = 'ModelAuth';
        }

        return sprintf(__DIR__ . '/stubs/%s.stub', str_replace('_', '.', Str::snake($this->type)));
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $template = '%s/%s.php';

        return sprintf(
            $template,
            $this->appPath(),
            str_replace('\\', '/', $name)
        );
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $id = $this->getKeyName();

        $traits = $this->getTraits();

        $extra = $this->getExtra();

        $timestamps = $this->getTimestamps();

        $fields = $this->getFields();

        $fillable = $this->getFillable();

        $casts = $this->getCasts();

        $dates = $this->getDates();

        $hidden = $this->getHidden();

        $belongsTo = $this->getBelongsTo();

        $belongsToMany = $this->getBelongsToMany();

        $belongsToManyPivot = $this->getBelongsToManyPivot();

        $belongsToManyPivotTimestamps = $this->getBelongsToManyPivotTimestamps();

        $hasOne = $this->getHasOne();

        $hasMany = $this->getHasMany();

        $hasManyThrough = $this->getHasManyThrough();

        $morphTo = $this->getMorphTo();

        $morphOne = $this->getMorphOne();

        $morphMany = $this->getMorphMany();

        $morphToMany = $this->getMorphToMany();

        $morphedByMany = $this->getMorphedByMany();

        $images = $this->getImages();

        $files = $this->getFiles();

        $touches = $this->getTouches();

        $with = $this->getWith();

        $search = [
            '{{traits}}',
            '{{phpdoc}}',
            '{{phpdoc_id}}',
            '{{phpdoc_properties}}',
            '{{phpdoc_timestamps}}',
            '{{phpdoc_belongs_to_properties}}',
            '{{phpdoc_belongs_to_many_properties}}',
            '{{phpdoc_belongs_to_methods}}',
            '{{phpdoc_belongs_to_many_methods}}',
            '{{phpdoc_has_one_properties}}',
            '{{phpdoc_has_one_methods}}',
            '{{phpdoc_has_many_properties}}',
            '{{phpdoc_has_many_methods}}',
            '{{phpdoc_has_many_through_properties}}',
            '{{phpdoc_has_many_through_methods}}',
            '{{phpdoc_morph_to_properties}}',
            '{{phpdoc_morph_to_methods}}',
            '{{phpdoc_morph_one_properties}}',
            '{{phpdoc_morph_one_methods}}',
            '{{phpdoc_morph_many_properties}}',
            '{{phpdoc_morph_many_methods}}',
            '{{phpdoc_morph_to_many_properties}}',
            '{{phpdoc_morph_to_many_methods}}',
            '{{phpdoc_morphed_by_many_properties}}',
            '{{phpdoc_morphed_by_many_methods}}',
            '{{use}}',
            '{{extra}}',
            '{{fillable}}',
            '{{casts}}',
            '{{dates}}',
            '{{hidden}}',
            '{{belongs_to}}',
            '{{belongs_to_many}}',
            '{{belongs_to_many_pivot}}',
            '{{belongs_to_many_pivot_timestamps}}',
            '{{has_one}}',
            '{{has_many}}',
            '{{has_many_through}}',
            '{{morph_to}}',
            '{{morph_one}}',
            '{{morph_many}}',
            '{{morph_to_many}}',
            '{{morphed_by_many}}',
            '{{images}}',
            '{{files}}',
            '{{with}}',
            '{{touches}}'
        ];

        $replace = [
            $this->dumpTraits($traits),
            $this->dumpPhpDoc([
                $this->dumpPhpDocId($id),
                $this->dumpPhpDocProperties($fields),
                $this->dumpPhpDocTimestamps($timestamps),
                $this->dumpPhpDocBelongsToProperties($belongsTo),
                $this->dumpPhpDocBelongsToManyProperties($belongsToMany),
                $this->dumpPhpDocBelongsToMethods($belongsTo),
                $this->dumpPhpDocBelongsToManyMethods($belongsToMany),
                $this->dumpPhpDocHasOneProperties($hasOne),
                $this->dumpPhpDocHasOneMethods($hasOne),
                $this->dumpPhpDocHasManyProperties($hasMany),
                $this->dumpPhpDocHasManyMethods($hasMany),
                $this->dumpPhpDocHasManyThroughProperties($hasManyThrough),
                $this->dumpPhpDocHasManyThroughMethods($hasManyThrough),
                $this->dumpPhpDocMorphToProperties($morphTo),
                $this->dumpPhpDocMorphToMethods($morphTo),
                $this->dumpPhpDocMorphOneProperties($morphOne),
                $this->dumpPhpDocMorphOneMethods($morphOne),
                $this->dumpPhpDocMorphManyProperties($morphMany),
                $this->dumpPhpDocMorphManyMethods($morphMany),
                $this->dumpPhpDocMorphToManyProperties($morphToMany),
                $this->dumpPhpDocMorphToManyMethods($morphToMany),
                $this->dumpPhpDocMorphedByManyProperties($morphedByMany),
                $this->dumpPhpDocMorphedByManyMethods($morphedByMany)
            ]),
            $this->dumpPhpDocId($id),
            $this->dumpPhpDocProperties($fields),
            $this->dumpPhpDocTimestamps($timestamps),
            $this->dumpPhpDocBelongsToProperties($belongsTo),
            $this->dumpPhpDocBelongsToManyProperties($belongsToMany),
            $this->dumpPhpDocBelongsToMethods($belongsTo),
            $this->dumpPhpDocBelongsToManyMethods($belongsToMany),
            $this->dumpPhpDocHasOneProperties($hasOne),
            $this->dumpPhpDocHasOneMethods($hasOne),
            $this->dumpPhpDocHasManyProperties($hasMany),
            $this->dumpPhpDocHasManyMethods($hasMany),
            $this->dumpPhpDocHasManyThroughProperties($hasManyThrough),
            $this->dumpPhpDocHasManyThroughMethods($hasManyThrough),
            $this->dumpPhpDocMorphToProperties($morphTo),
            $this->dumpPhpDocMorphToMethods($morphTo),
            $this->dumpPhpDocMorphOneProperties($morphOne),
            $this->dumpPhpDocMorphOneMethods($morphOne),
            $this->dumpPhpDocMorphManyProperties($morphMany),
            $this->dumpPhpDocMorphManyMethods($morphMany),
            $this->dumpPhpDocMorphToManyProperties($morphToMany),
            $this->dumpPhpDocMorphToManyMethods($morphToMany),
            $this->dumpPhpDocMorphedByManyProperties($morphedByMany),
            $this->dumpPhpDocMorphedByManyMethods($morphedByMany),
            $this->dumpUse($traits),
            $this->dumpExtra($extra),
            $this->dumpFillable($fillable),
            $this->dumpCasts($casts),
            $this->dumpDates($dates),
            $this->dumpHidden($hidden),
            $this->dumpBelongsTo($belongsTo),
            $this->dumpBelongsToMany($belongsToMany),
            $this->dumpBelongsToManyPivot($belongsToManyPivot),
            $this->dumpBelongsToManyPivotTimestamps($belongsToManyPivotTimestamps),
            $this->dumpHasOne($hasOne),
            $this->dumpHasMany($hasMany),
            $this->dumpHasManyThrough($hasManyThrough),
            $this->dumpMorphTo($morphTo),
            $this->dumpMorphOne($morphOne),
            $this->dumpMorphMany($morphMany),
            $this->dumpMorphToMany($morphToMany),
            $this->dumpMorphedByMany($morphedByMany),
            $this->dumpImages($images),
            $this->dumpFiles($files),
            $this->dumpWith($with),
            $this->dumpTouches($touches)
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

    /**
     * Display success message to console.
     */
    protected function success()
    {
        parent::success();

        if ($this->hasImages()) {

            $lines = [];

            $lines[] = sprintf("\t\t\App\%s::class => [", Str::studly($this->argument('name')));

            foreach ($this->getImages() as $image) {
                $lines[] = sprintf(
                    implode(
                        "\n",
                        [
                            "\t\t\t'%s' => [",
                            "\t\t\t\t'width' => 150,",
                            "\t\t\t\t'height' => 150,",
                            "\t\t\t\t'crop' => true,",
                            "\t\t\t\t'quality' => 90,",
                            "\t\t\t],",
                        ]
                    ),
                    $image->name
                );
            }

            $lines[] = "\t\t],";

            $this->updateCodeSuggestion(
                'config/images.php',
                'dimensions',
                implode("\n", $lines),
                2
            );
        }

        if ($this->isAuthResource()) {

            $this->updateCodeSuggestion(
                'config/auth.php',
                'guards',
                sprintf(
                    "'%s' => [\n\t'driver' => 'session',\n\t'provider' => '%s',\n],",
                    Str::snake($this->option('namespace')),
                    Str::snake(Str::plural($this->argument('name')))
                ),
                2
            );

            $this->updateCodeSuggestion(
                'config/auth.php',
                'providers',
                sprintf(
                    "'%s' => [\n\t'driver' => 'eloquent',\n\t'model' => \App\%s::class,\n],",
                    Str::snake(Str::plural($this->argument('name'))),
                    Str::studly($this->argument('name'))
                ),
                2
            );

            $this->updateCodeSuggestion(
                'config/auth.php',
                'passwords',
                sprintf(
                    "'%s' => [\n\t'provider' => '%s',\n\t'table' => '%s_password_resets',\n\t'expire' => 60,\n],",
                    Str::snake($this->option('namespace')),
                    Str::snake(Str::plural($this->argument('name'))),
                    Str::snake(Str::plural($this->argument('name')))
                ),
                2
            );
        }
    }
}
