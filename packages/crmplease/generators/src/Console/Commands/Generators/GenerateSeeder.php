<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasSeederAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\SeederAttributes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GenerateSeeder extends GeneratorCommand implements HasModelAttributes, HasSeederAttributes
{
    use ModelAttributes, SeederAttributes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate seeder';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * @param Collection $relations
     *
     * @return string
     */
    protected function dumpStaticRelations(Collection $relations)
    {
        if (!$relations->count()) {
            return "";
        }

        return sprintf(
            "\t\tstatic %s;\n",
            $relations->pluck('relation')->map(
                function ($relation) {
                    return sprintf("$%s", Str::plural($relation));
                }
            )->unique()->implode(", ")
        );
    }

    /**
     * @param Collection $relations
     *
     * @return string
     */
    protected function dumpUseStaticRelations(Collection $relations)
    {
        if (!$relations->count()) {
            return "";
        }

        return sprintf(
            "use (%s) ",
            $relations->pluck('relation')->map(
                function ($relation) {
                    return sprintf("$%s", Str::plural($relation));
                }
            )->unique()->implode(", ")
        );
    }

    /**
     * @param Collection $relations
     *
     * @return string
     */
    protected function dumpBelongsToRelations(Collection $relations)
    {
        if (!$relations->count()) {
            return "";
        }

        return $relations->pluck('relation')->map(
            function ($relation) {
                return sprintf(
                    "\t\t/** @var \Illuminate\Database\Eloquent\Collection $%s */\n\t\t$%s = $%s ?: app(\App\Repositories\Contracts\%sRepository::class)->all();\n",
                    Str::plural($relation),
                    Str::plural($relation),
                    Str::plural($relation),
                    Str::studly(Str::singular($relation))
                );
            }
        )->unique()->implode("\n");
    }

    /**
     * @param Collection $relations
     *
     * @return string
     */
    protected function dumpBelongsToManyRelations(Collection $relations)
    {
        return $this->dumpBelongsToRelations($relations);
    }

    /**
     * @param Collection $relations
     *
     * @return string
     */
    protected function dumpBelongsToAssociate(Collection $relations)
    {
        if (!$relations->count()) {
            return "";
        }

        return $relations->map(
            function ($relation) {
                return sprintf(
                    "\t\t\t$%s->%s()->associate($%s->random());",
                    Str::camel($this->getClassName()),
                    $relation->relation,
                    Str::plural($relation->relation)
                );
            }
        )->unique()->implode("\n");
    }

    /**
     * @param Collection $relations
     *
     * @return string
     */
    protected function dumpBelongsToManySync(Collection $relations)
    {
        if (!$relations->count()) {
            return "";
        }

        $pivot = $this->getBelongsToManyPivot()->groupBy('relation');

        return $relations->map(
            function ($relation) use ($pivot) {
                if (isset($pivot[$relation->relation])) {

                    /** @var Collection $pivotFields */
                    $pivotFields = $pivot[$relation->relation];

                    return sprintf(
                        implode("\n", [
                            "\t\t\t$%s->%s()->sync(",
                            "\t\t\t\t$%s->random(rand(1, 5))->mapWithKeys(function (\$entity) {",
                            "\t\t\t\t\t\$faker = Faker\Factory::create();",
                            "\t\t\t\t\treturn [",
                            "\t\t\t\t\t\t\$entity->getKey() => [",
                            "%s",
                            "\t\t\t\t\t\t]",
                            "\t\t\t\t\t];",
                            "\t\t\t\t})",
                            "\t\t\t);"
                        ]),
                        Str::camel($this->getClassName()),
                        $relation->relation,
                        $relation->relation,
                        $pivotFields->map(function ($pivotField) {
                            return sprintf("\t\t\t\t\t\t\t'%s' => %s,", $pivotField->name, $pivotField->faker);
                        })->implode("\n")
                    );
                }

                return sprintf(
                    "\t\t\t$%s->%s()->sync($%s->random(rand(1, 5)));",
                    Str::camel($this->getClassName()),
                    $relation->relation,
                    $relation->relation
                );
            }
        )->unique()->implode("\n");
    }

    /**
     * @param Collection $relations
     *
     * @return string
     */
    protected function dumpSaveModel(Collection $relations)
    {
        if (!$relations->count()) {
            return "";
        }

        return sprintf("\t\t\t$%s->save();", Str::camel($this->getClassName()));
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
        $name = Str::plural($this->getClassName());

        $template = Str::endsWith('TableSeeder', $name)
            ? '%s/database/seeds/%s.php'
            : '%s/database/seeds/%sTableSeeder.php';

        return sprintf($template, $this->basePath(), $name);
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

        $relations = $this->getRelations();

        $belongsTo = $this->getBelongsTo();

        $belongsToMany = $this->getBelongsToMany();

        $seedCount = $this->getSeedCount();

        $search = [
            '{{static_relations}}',
            '{{use_static_relations}}',
            '{{belongs_to_repositories}}',
            '{{belongs_to_many_repositories}}',
            '{{belongs_to_associate}}',
            '{{belongs_to_many_sync}}',
            '{{save_model}}',
            '{{seed_count}}',
        ];

        $replace = [
            $this->dumpStaticRelations($relations),
            $this->dumpUseStaticRelations($relations),
            $this->dumpBelongsToRelations($belongsTo),
            $this->dumpBelongsToManyRelations($belongsToMany),
            $this->dumpBelongsToAssociate($belongsTo),
            $this->dumpBelongsToManySync($belongsToMany),
            $this->dumpSaveModel($relations),
            $this->dumpSeedCount($seedCount)
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
            $this->getSeederOptions()
        );
    }

    protected function success()
    {
        parent::success();

        $this->updateCodeSuggestion(
            'database/seeds/DatabaseSeeder.php',
            'seeder',
            sprintf(
                "\$this->call(%sTableSeeder::class);",
                Str::plural(Str::studly($this->getClassName()))
            ),
            3
        );
    }
}
