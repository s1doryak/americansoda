<?php namespace Crmplease\MaterialAdmin\Console\Commands\Resources;

use Crmplease\MaterialAdmin\Events\ResourceStored;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

abstract class ResourceCreator extends \Illuminate\Console\Command implements ResourceCreatorContract
{
    /**
     * @var \Crmplease\MaterialAdmin\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
     */
    protected $repository;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $resource;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $findOrCreateData = [];

    /**
     * @return string
     */
    public function getEventNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getEventResource()
    {
        return $this->resource;
    }

    /**
     * @return string
     */
    public function getEventAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return $this->params;
    }

    /**
     * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model $model
     * @return array
     */
    public function getEventAttributes($model)
    {
        return $model->getAttributes();
    }

    /**
     * @param string $relation
     * @return string
     */
    protected function getFindOrCreateColumn($relation)
    {
        $default = 'name';

        if (isset($this->findOrCreateData[$relation])) {

            $config = $this->findOrCreateData[$relation];

            if (is_array($config)) {
                if (isset($config['lists'])) {
                    return $config['lists'];
                }

                return $default;
            }

            return $config;
        }

        return $default;
    }

    /**
     * @param string $relation
     * @return \Crmplease\MaterialAdmin\Repositories\RepositoryInterface
     */
    protected function getFindOrCreateRepository($relation)
    {
        $default = $this->{$relation};

        if (isset($this->findOrCreateData[$relation])) {

            $config = $this->findOrCreateData[$relation];

            if (is_array($config)) {
                if (isset($config['repository'])) {
                    return $this->{$config['repository']};
                }

                return $default;
            }

            return $default;
        }

        return $default;
    }

    /**
     * @return array
     */
    protected function getDefaultOptions()
    {
        return [
            ['skip-event', null, InputOption::VALUE_NONE, 'Skip entity successfully created event fire.'],
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        $options = $this->getDefaultOptions();

        foreach ($this->model->getFillable() as $option) {
            $options[] = [$option, null, InputOption::VALUE_OPTIONAL, '', null];
        }

        foreach ($this->model->getBelongsToRelations() as $option) {
            $options[] = [$option, null, InputOption::VALUE_OPTIONAL, '', null];
        }

        foreach ($this->model->getBelongsToManyRelations() as $option) {
            $options[] = [$option, null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, '', null];
        }

        return $options;
    }

    /**
     * @return Collection
     */
    public function handleOptions()
    {
        return collect(
            $this->options()
        )->map(function ($value, $option) {

            $method = Str::camel(sprintf('parse_%s_option', $option));

            if (method_exists($this, $method)) {
                return call_user_func([$this, $method], $value);
            }

            return $value;
        });
    }

    /**
     * @param Collection $options
     * @return Collection
     */
    public function getAttributes($options)
    {
        return $options->only(
            $this->model->getFillable()
        );
    }

    /**
     * @param Collection $options
     * @return Collection
     */
    public function getRelations($options)
    {
        return $options->only(
            $this->model->getRelations()
        );
    }

    /**
     * @param Collection $attributes
     */
    public function fill($attributes)
    {
        $this->model->fill(
            $attributes->toArray()
        )->save();
    }

    /**
     * @param Collection $relations
     */
    public function associateBelongsToRelations($relations)
    {
        foreach ($this->model->getBelongsToRelations() as $relation) {
            if ($relations->has($relation)) {

                if (is_null($relations->get($relation))) {
                    continue;
                }

                $repository = $this->getFindOrCreateRepository(Str::plural($relation));

                if (is_numeric($relations->get($relation))) {
                    $parent = $relations->get($relation);
                } else {
                    $parent = $repository->firstOrCreate([
                        $this->getFindOrCreateColumn(Str::plural($relation)) => (string)$relations->get($relation)
                    ])->getKey();
                }

                $this->model->{$relation}()->associate(
                    $parent
                );
            }
        }

        $this->model->save();
    }

    /**
     * @param Collection $relations
     */
    public function syncBelongsToManyRelations($relations)
    {
        foreach ($this->model->getBelongsToManyRelations() as $relation) {
            if ($relations->has($relation)) {

                if (is_null($relations->get($relation))) {
                    continue;
                }

                $repository = $this->getFindOrCreateRepository(Str::plural($relation));

                $parent = array_map(function ($item) use ($relation, $repository) {
                    if (is_numeric($item)) {
                        return $item;
                    } else {
                        return $repository->firstOrCreate([
                            $this->getFindOrCreateColumn(Str::plural($relation)) => (string)$item
                        ])->getKey();
                    }
                }, (array)$relations->get($relation));

                $this->model->{$relation}()->sync(
                    $parent
                );
            }
        }
    }

    /**
     * @param Collection $relations
     */
    public function setupRelations($relations)
    {
        $this->associateBelongsToRelations($relations);
        $this->syncBelongsToManyRelations($relations);
    }

    /**
     * Execute the console command.
     *
     * @return boolean|null
     */
    public function handle()
    {
        try {
            $options = $this->handleOptions();

            $this->fill(
                $this->getAttributes($options)
            );

            $this->setupRelations(
                $this->getRelations($options)
            );

            if ($this->option('skip-event')) {

                $this->info(sprintf("%s created successfully with ID: %s", class_basename($this->model), $this->model->getKey()));

            } else {

                $fired = event(new ResourceStored(
                    $this->getEventNamespace(),
                    $this->getEventResource(),
                    $this->getEventAction(),
                    $this->getEventAttributes($this->model),
                    $this->getEventParams()
                ));

                $this->info(sprintf("%s created successfully with ID: %s and %d events fired.", class_basename($this->model), $this->model->getKey(), count($fired)));
            }

        } catch (\Throwable $e) {

            $this->error(sprintf("%s creation failed!", class_basename($this->model)));
            $this->comment($e->getMessage());

        }

        return true;
    }
}
