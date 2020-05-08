<?php

namespace Crmplease\MaterialAdmin\Routing;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use Crmplease\MaterialAdmin\Forms\Extensions\FormBuilder;
use Crmplease\MaterialAdmin\Forms\Extensions\FormUrlBuilder;
use Crmplease\MaterialAdmin\Http\ResponseHelper;
use Crmplease\MaterialAdmin\Providers\ResourceServiceProvider;
use Crmplease\MaterialAdmin\Repositories\RepositoryEloquent;
use Crmplease\MaterialAdmin\Events\ResourceDestroyed;
use Crmplease\MaterialAdmin\Events\ResourceRestored;
use Crmplease\MaterialAdmin\Events\ResourceRequested;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceTrashed;
use Crmplease\MaterialAdmin\Events\ResourceUpdated;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Translation\Translator;

abstract class ResourceController extends Controller
{
    /**
     * @var string
     */
    protected $defaultMiddleware;

    /**
     * @var array
     */
    protected $defaultMiddlewareOptions = [];

    /**
     * @var string
     */
    protected $translationNamespace;

    /**
     * @var string
     */
    protected $translationPrefix = 'models/';

    /**
     * @var string
     */
    protected $viewNamespace;

    /**
     * @var string
     */
    protected $viewPrefix = '';

    /**
     * @var string
     */
    protected $viewDefaultNamespace = 'material-admin::';

    /**
     * @var string
     */
    protected $dataTable;

    /**
     * @var RepositoryEloquent
     */
    protected $repository;

    /**
     * @var array
     */
    protected $with = [

    ];

    /**
     * Array describing additional data for the HTML 'create' form.
     *
     * Example:
     *
     * 'customer_orders' => [
     *     'repository' => 'orders',
     *     'lists' => 'number', // or 'lists' => ['number', 'id']
     *     'selected' => 'order' // or 'selected' => ['order, 'id']
     * ],
     * 'employees' => [
     *     'repository' => 'employees',
     *     'lists' => 'name',
     *     'selected' => 'employee'
     * ]
     *
     * @var array
     * @see mapFormDataConfigToAction()
     */
    protected $createActionFormData = [

    ];

    /**
     * Array describing additional data for the HTML 'edit' form.
     *
     * @var array
     */
    protected $editActionFormData = [

    ];

    /**
     * Default editing actions. @see getEditingActions()
     *
     * @var array
     */
    protected $defaultEditingActions = [
        'create', 'edit'
    ];

    /**
     * Custom editing actions. @see getEditingActions()
     *
     * @var array
     */
    protected $editingActions = [

    ];

    /**
     * Default editing actions. @see getPersistingActions()
     *
     * @var array
     */
    protected $defaultPersistingActions = [
        'store', 'update'
    ];

    /**
     * Custom editing actions. @see getPersistingActions()
     *
     * @var array
     */
    protected $persistingActions = [

    ];

    /**
     * Default popup windows. @see getPopupActions()
     *
     * @var array
     */
    protected $defaultPopupActions = [
        'show'
    ];

    /**
     * Popup windows. @see getPopupActions()
     *
     * Example:
     *
     *  'create',
     *  'edit',
     *
     * or size specific:
     *
     *  'create' => 'large',
     *  'edit' => 'fullscreen',
     *
     * or advanced configuration:
     *
     *  'create' => [
     *      'resource' => 'user',
     *      'title' => 'Custom Title',
     *      'class' => 'modal-lg',
     *  ],
     *  'edit' => [
     *      'resource' => 'user',
     *      'title' => 'Custom Title',
     *      'class' => 'modal-fluid',
     *  ],
     *
     */
    protected $popupActions = [

    ];

    /**
     * Additional view response data.
     *
     * @var array
     */
    protected $defaultViewData = [

    ];

    /**
     * @param string|null $action
     * @return array
     */
    protected function getWith($action = null)
    {
        return $this->with;
    }

    /**
     * @param string|null $action
     * @return \Closure
     */
    protected function getScope($action = null)
    {
        return function ($query) {
            return $query->withTrashed();
        };
    }

    /**
     * @param string $action
     * @return boolean|string
     */
    protected function getViewName($action)
    {
        $view = "{$this->getViewNamespace()}resources.{$this->getResource()}.{$action}";
        $default = "{$this->getViewNamespace()}actions.{$action}";
        $fallback = "{$this->getViewDefaultNamespace()}actions.{$action}";

        if (view()->exists($view)) {
            return $view;
        } else if (view()->exists($default)) {
            return $default;
        } else if (view()->exists($fallback)) {
            return $fallback;
        }

        return false;
    }

    /**
     * Provide additional 'index' view data.
     *
     * @param string|null $action
     * @return array
     */
    protected function getDataTableViewData($action = null)
    {
        return [];
    }

    /**
     * Define index view name.
     *
     * @param string|null $action
     * @return string
     */
    protected function getDataTableViewName($action = null)
    {
        return $this->getViewName($action) ?: $this->getViewName('index');
    }

    /**
     * Provide additional 'create' view data.
     *
     * @return array
     */
    protected function getCreateViewData()
    {
        return [];
    }

    /**
     * Define 'create' view name.
     *
     * @return string
     */
    protected function getCreateViewName()
    {
        return $this->getViewName('create');
    }

    /**
     * Prepare 'create' form options.
     *
     * @return array
     */
    protected function getCreateActionFormOptions()
    {
        return [];
    }

    /**
     * Gather additional form data for create action.
     *
     * @return array
     */
    protected function getCreateActionFormData()
    {
        $data = empty($this->createActionFormData) ? $this->editActionFormData : $this->createActionFormData;

        return $this->mapFormDataConfigToAction($data);
    }

    /**
     * Provide additional 'show' view data.
     *
     * @param mixed $model
     * @return array
     */
    protected function getShowViewData($model)
    {
        return [];
    }

    /**
     * Define 'edit' view name.
     *
     * @return string
     */
    protected function getShowViewName()
    {
        return $this->getViewName('show');
    }

    /**
     * Define 'edit' view name.
     *
     * @return string
     */
    protected function getEditViewName()
    {
        return $this->getViewName('edit') ?: $this->getCreateViewName();
    }

    /**
     * Provide additional 'edit' view data.
     *
     * @param mixed $model
     * @return array
     */
    protected function getEditViewData($model)
    {
        return [];
    }

    /**
     * Prepare 'edit' form options.
     *
     * @param mixed $model
     * @return array
     */
    protected function getEditActionFormOptions($model = null)
    {
        return [];
    }

    /**
     * Gather additional form data form update action.
     *
     * @param mixed $model
     *
     * @return array
     */
    protected function getEditActionFormData($model = null)
    {
        return array_merge(
            $model ? $model->transform() : [],
            $this->mapFormDataConfigToAction($this->editActionFormData, $model)
        );
    }

    /**
     * Transform configuration array into appropriate data format.
     *
     * Example:
     *
     * Having this structure of the configuration...
     *
     *  'customer_order' => 'number',
     *  'employees' => 'name',
     *
     *  or
     *
     * 'customer_orders' => [
     *     'repository' => 'orders',
     *     'lists' => 'number', // or 'lists' => ['number', 'id']
     *     'selected' => 'order' // or 'selected' => ['order, 'id']
     * ],
     * 'employees' => [
     *     'repository' => 'employees',
     *     'lists' => 'name',
     *     'selected' => 'employee'
     * ]
     *
     * You'll get this data format:
     *
     * 'customer_orders' => [
     *     'items' => $this->orders->lists('number', 'id'),
     *     'selected' => $model->order->id
     * ],
     * 'employees' => [
     *     'items' => $this->employees->lists('name', 'id'),
     *     'selected' => $model->employee->id
     * ]
     *
     * @param array $config
     * @param mixed $model
     * @return array
     */
    protected function mapFormDataConfigToAction(array $config, $model = null)
    {
        $keys = array_keys($config);
        $mapped = array_map(
            function ($relation) use ($config, $model) {

                $item = $config[$relation];

                if (is_array($item)) {
                    $repository = $item['repository'] ?? Str::camel($relation);

                    if (isset($item['query'])) {
                        $this->{$repository}->scopeQuery($item['query']($model));
                    }

                    if (is_array($item['lists'])) {
                        $column = Arr::get($item, 'lists.0');
                        $field = Arr::get($item, 'lists.1', 'id');
                    } else {
                        $column = $item['lists'];
                        $field = 'id';
                    }

                    if (isset($item['selected'])) {
                        if (is_array($item['selected'])) {
                            $parent = Arr::get($item, 'selected.0');
                            $parentField = Arr::get($item, 'selected.1', 'id');
                        } else {
                            $parent = $item['selected'];
                            $parentField = 'id';
                        }
                    } else {
                        $parent = Str::singular(Str::camel($relation));
                        $parentField = 'id';
                    }

                    if (isset($item['order'])) {
                        if (is_array($item['order'])) {
                            $orderColumn = $item[0] ?? $column;
                            $orderDirection = $item[1] ?? 'asc';
                        } else {
                            $orderColumn = $item['order'];
                            $orderDirection = 'asc';
                        }
                    } else {
                        $orderColumn = $item['order_column'] ?? $column;
                        $orderDirection = $item['order_direction'] ?? 'asc';
                    }

                } else {
                    $repository = Str::camel($relation);
                    $column = $item;
                    $field = 'id';
                    $parent = Str::singular(Str::camel($relation));
                    $parentField = 'id';
                    $orderColumn = $column;
                    $orderDirection = 'asc';
                }

                if (isset($item['items'])) {

                    if (is_callable($item['items'])) {
                        $collection = call_user_func_array($item['items'], [$model]);
                    } else {
                        $collection = $item['items'];
                    }

                    if (false === $collection instanceof Collection) {
                        /** @var Collection $collection */
                        $collection = new Collection($collection);
                    }

                } else {
                    /** @var Collection $collection */
                    $collection = $this->{$repository}
                        ->orderBy(
                            $orderColumn,
                            $orderDirection
                        )
                        ->all();
                }

                $options = [];

                if (isset($item['extra'])) {

                    $attrs = (array)$item['extra'];

                    /** @var \Crmplease\MaterialAdmin\Database\Eloquent\Model $result */
                    foreach ($collection as $result) {

                        foreach ($attrs as $attr => $data) {

                            if (is_numeric($attr)) {
                                $attr = $data;
                            }

                            if (!isset($options[$result->getKey()])) {
                                $options[$result->getKey()] = [];
                            }

                            if (is_callable($data)) {
                                $options[$result->getKey()]['data-' . $attr] = call_user_func_array($data, [$result, $attr]);
                            } else {
                                $options[$result->getKey()]['data-' . $attr] = (string)$result->{$data};
                            }

                        }

                    }

                }

                $items = $collection->pluck($column, $field)->toArray();

                $mapped = compact('items', 'options');

                if (is_object($parent)) {
                    $mapped['selected'] = $parent->{$parentField};
                } else {
                    if ($model && $parent) {
                        if ($model->{$parent}) {
                            if (is_object($model->{$parent})) {
                                if ($model->{$parent} instanceof Collection) {
                                    $mapped['selected'] = $model->{$parent}->toArray();
                                } else {
                                    $mapped['selected'] = $model->{$parent}->{$parentField};
                                }
                            } else {
                                $mapped['selected'] = $model->{$parent};
                            }
                        } elseif ($model->{Str::plural($parent)}) {
                            if (is_object($model->{Str::plural($parent)})) {
                                $mapped['selected'] = $model->{Str::plural($parent)}->pluck($parentField)->toArray();
                            } else {
                                $mapped['selected'] = $model->{Str::plural($parent)};
                            }
                        }
                    }
                }

                return $mapped;
            },
            $keys
        );

        return array_combine($keys, $mapped);
    }

    /**
     * Build redirect URL to point user after successful store.
     *
     * @param string $action
     * @param mixed|null $model
     * @return string
     */
    protected function getRedirectUrl($action, $model = null)
    {
        if ($this->getPrefix()) {
            return route("{$this->getPrefix()}.{$this->getResource()}.index");
        } else {
            return route("{$this->getResource()}.index");
        }
    }

    /**
     * Check whether user should be returned back after action.
     *
     * @param string|$action
     * @param mixed|null $request
     * @return boolean
     */
    protected function shouldReturnBack($action, $request = null)
    {
        return false;
    }

    /**
     * @param string $action
     * @return ResponseHelper
     */
    protected function getResponseHelper($action)
    {
        return new ResponseHelper($action);
    }

    /**
     * @param $action
     * @param null $model
     * @param null $request
     * @return array
     */
    protected function getResponseExtraData($action, $model = null, $request = null)
    {
        return [];
    }

    /**
     * Build 'success' response.
     *
     * @param ResponseHelper $helper
     * @param array $extra
     * @return mixed
     */
    protected function respondWithSuccess(ResponseHelper $helper, array $extra = [])
    {
        if ($helper->hasMessage()) {
            $message = $helper->getMessage();
        } else {
            $message = trans("{$this->getTranslationNamespace()}{$this->getTranslationPrefix()}.{$helper->getAction()}.success");
        }

        if (is_ajax()) {
            $data = ['success' => $message];

            if ($helper->hasData()) {
                $data = array_merge($data, $helper->getData());
            }

            if ($extra) {
                $data = array_merge($data, $extra);
            }

            return json($data);
        }

        if ($helper->willReturnBack()) {
            $response = redirect()->back();
        } else {
            $response = redirect($helper->getUrl());
        }

        return $response->withSuccess($message);
    }

    /**
     * Build 'error' response.
     *
     * @param ResponseHelper $helper
     * @param array $extra
     * @return mixed
     */
    protected function respondWithError(ResponseHelper $helper, array $extra = [])
    {
        if ($helper->hasMessage()) {
            $message = $helper->getMessage();
        } else {
            $message = trans("{$this->getTranslationNamespace()}{$this->getTranslationPrefix()}.{$helper->getAction()}.error");
        }

        if (is_ajax()) {
            $data = ['error' => $message];

            if ($helper->hasData()) {
                $data = array_merge($data, $helper->getData());
            }

            if ($extra) {
                $data = array_merge($data, $extra);
            }

            return json($data, 500);
        }

        return redirect()->back()->withInput()->withErrors($message);
    }

    /**
     * Build 'success' response.
     *
     * @param ResponseHelper $helper
     * @return mixed
     */
    protected function respondWithRedirect(ResponseHelper $helper)
    {
        if ($helper->hasMessage()) {
            $message = $helper->getMessage();
        } else {
            $message = trans("{$this->getTranslationNamespace()}{$this->getTranslationPrefix()}.{$helper->getAction()}.redirect");
        }

        if ($helper->willReturnBack()) {
            $response = redirect()->back();
        } else {
            $response = redirect($helper->getUrl());
        }

        return $response->withSuccess($message);
    }

    /**
     * Define methods that show edit pages.
     *
     * @return array
     */
    protected function getEditingActions()
    {
        return array_unique(
            array_merge(
                $this->defaultEditingActions,
                $this->editingActions
            )
        );
    }

    /**
     * Define methods that must be validated.
     *
     * @return array
     */
    protected function getPersistingActions()
    {
        return array_unique(
            array_merge(
                $this->defaultPersistingActions,
                $this->persistingActions
            )
        );
    }

    /**
     * Define methods that show popup actions.
     *
     * @return array
     */
    protected function getPopupActions()
    {
        return $this->processPopupActionParams(
            array_merge(
                $this->defaultEditingActions,
                $this->editingActions,
                $this->defaultPopupActions,
                $this->popupActions
            )
        );
    }

    /**
     * @param array $actions
     * @return array
     */
    protected function processPopupActionParams(array $actions = [])
    {
        $processed = [];

        $resource = $this->getResource();

        $classmap = [
            'small' => 'modal-sm',
            'large' => 'modal-lg',
            'fullscreen' => 'modal-fluid',
        ];

        foreach ($actions as $action => $params) {
            $action = is_numeric($action) ?  $params : $action;

            if (is_array($params)) {
                $resource = Arr::get($params, 'resource', $this->getResource());
                $title = Arr::get($params, 'title', $this->makePopupTitle($action));
                $neededClassName = Arr::get($params, 'class', 'default');
                $class = $this->mapPopupClassName($neededClassName);
            } else {
                $resource = $this->getResource();
                $title = $this->makePopupTitle($action);
                $class = $this->mapPopupClassName($params);
            }

            $processed[$action] = $params;
            $processed[$action] = [
                'resource' => $resource,
                'title' => $title,
                'class' => $class
            ];
        }

        return $processed;
    }

    /**
     * @param $key
     * @return string
     */
    protected function mapPopupClassName($key)
    {
        $classmap = [
            'default' => 'modal-md',
            'small' => 'modal-sm',
            'large' => 'modal-lg',
            'fullscreen' => 'modal-fluid',
        ];

        return Arr::get($classmap, $key, 'modal-md');
    }

    /**
     * @param $action
     * @return array|Translator|mixed|string|null
     */
    protected function makePopupTitle($action)
    {
        return trans("{$this->getTranslationNamespace()}{$this->getTranslationPrefix()}.{$action}.title");
    }


    /**
     * Provide default view response data.
     *
     * @return array
     */
    protected function getDefaultViewData()
    {
        $data = [
            'prefix' => $this->getPrefix(),
            'resource' => $this->getResource(),
            'translationNamespace' => $this->getTranslationNamespace(),
            'translationPrefix' => $this->getTranslationPrefix(),
            'viewNamespace' => $this->getViewNamespace(),
            'viewPrefix' => $this->getViewPrefix(),
            'editingActions' => $this->getEditingActions(),
            'persistingActions' => $this->getPersistingActions(),
            'popupActions' => $this->getPopupActions(),
        ];

        return array_merge(
            $this->defaultViewData,
            $data
        );
    }

    /**
     * Return repository.
     *
     * @return RepositoryEloquent
     */
    protected function getRepository()
    {
        return $this->repository;
    }

    /**
     * Return current resource name.
     *
     * @return string
     */
    protected function getResource()
    {
        if (empty($this->resource)) {
            $this->resource = resource_name();
        }

        return $this->resource;
    }

    /**
     * Return current resource id.
     *
     * @return integer
     */
    protected function getResourceId()
    {
        $parameter = Arr::last(explode('.', $this->getResource()));

        return resource_id($parameter);
    }

    /**
     * Build resource provider instance.
     *
     * @return ResourceServiceProvider
     */
    protected function getResourceProvider()
    {
        return new ResourceServiceProvider(
            $this->getResource(),
            $this->getPrefix(),
            app(FormBuilder::class),
            app(FormUrlBuilder::class),
            app(Router::class)
        );
    }

    /**
     * Provide translation prefix.
     *
     * @return string
     */
    protected function getTranslationNamespace()
    {
        return $this->translationNamespace;
    }

    /**
     * Provide translation prefix.
     *
     * @return string
     */
    protected function getTranslationPrefix()
    {
        return $this->translationPrefix . $this->getResource();
    }

    /**
     * Provide translation prefix.
     *
     * @return string
     */
    protected function getViewNamespace()
    {
        return $this->viewNamespace ?: $this->getPrefix() . '::';
    }

    /**
     * Provide translation prefix.
     *
     * @return string
     */
    protected function getViewDefaultNamespace()
    {
        return $this->viewDefaultNamespace;
    }

    /**
     * Provide translation prefix.
     *
     * @return string
     */
    protected function getViewPrefix()
    {
        return $this->viewPrefix;
    }

    /**
     * ToDo: Refactor pre querying models.
     *
     * @param string $action
     * @param array $parameters
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function callAction($action, $parameters)
    {
        return call_user_func_array([$this, $action], $parameters);

        try {

            if (in_array($action, $this->getPersistingActions())) {

                $provider = $this->getResourceProvider();

                if ($id = $this->getResourceId()) {

                    $model = $this->repository
                        ->with($this->getWith($action))
                        ->scopeQuery($this->getScope($action))
                        ->find($id);

                    if ($model) {
                        $provider->setModel($model);
                    }
                }

                $parameters = Arr::prepend($parameters, $provider->getRequest($action));
            }

            return call_user_func_array([$this, $action], $parameters);

        } catch (\Throwable $e) {
            return $this->respondWithError(
                $this->getResponseHelper($action)
                    ->setThrowable($e)
                    ->setMessage($e->getMessage()),
                $this->getResponseExtraData($action)
            );
        }
    }

    /**
     * Get datatable for the resource.
     *
     * @return DataTable
     */
    protected function getDatatable()
    {
        if (class_exists($this->dataTable)) {
            return app($this->dataTable);
        }

        $class = sprintf(
            '\App\DataTables\%s\%sDataTable',
            Str::studly($this->getPrefix()),
            Str::studly($this->getResource())
        );

        if (class_exists($class)) {
            return app($class);
        }

        return app(DataTable::class);
    }

    /**
     * @param string $action
     * @return mixed
     */
    protected function renderDatatable($action)
    {
        $title = trans("{$this->getTranslationNamespace()}{$this->getTranslationPrefix()}.{$action}.title");

        $data = array_merge(
            compact('title'),
            $this->getDataTableViewData($action),
            $this->getDefaultViewData()
        );

        return $this->getDatatable()
            ->with('repository', $this->getRepository()->with($this->getWith($action)))
            ->with('resource', $this->getResource())
            ->with('prefix', $this->getPrefix())
            ->with('translationNamespace', $this->getTranslationNamespace())
            ->with('translationPrefix', $this->getTranslationPrefix())
            ->with('viewNamespace', $this->getViewNamespace())
            ->with('viewPrefix', $this->getViewPrefix())
            ->with('guard', $this->guard())
            ->render($this->getDataTableViewName($action), $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $action = 'index';

        return $this->renderDatatable($action);
    }

    /**
     * Display listing of the trashed items of a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $action = 'trashed';

        return $this->renderDatatable($action);
    }

    /**
     * Show resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show()
    {
        $action = 'show';

        $title = trans("{$this->getTranslationNamespace()}{$this->getTranslationPrefix()}.{$action}.title");

        $id = $this->getResourceId();

        $model = $this->repository
            ->with($this->getWith($action))
            ->scopeQuery($this->getScope($action))
            ->find($id);

        $provider = $this->getResourceProvider()
            ->setModel($model);

        $request = $provider->getRequest($action);

        event(
            new ResourceRequested(
                $this->getPrefix(),
                $this->getResource(),
                $action,
                $model->getAttributes(),
                $request->all()
            )
        );

        $data = array_merge(
            compact('title', 'model'),
            $this->getShowViewData($model),
            $this->getDefaultViewData()
        );

        return view($this->getShowViewName(), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function create()
    {
        $action = 'create';

        $title = trans("{$this->getTranslationNamespace()}{$this->getTranslationPrefix()}.{$action}.title");

        $provider = $this->getResourceProvider();

        $form = $provider->getForm(
            $action,
            $this->getCreateActionFormOptions(),
            $this->getCreateActionFormData()
        );

        $data = array_merge(
            compact('title', 'form'),
            $this->getCreateViewData(),
            $this->getDefaultViewData()
        );

        return view($this->getCreateViewName(), $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit()
    {
        $action = 'edit';

        $title = trans("{$this->getTranslationNamespace()}{$this->getTranslationPrefix()}.{$action}.title");

        $id = $this->getResourceId();

        $model = $this->repository
            ->with($this->getWith($action))
            ->scopeQuery($this->getScope($action))
            ->find($id);

        $provider = $this->getResourceProvider()->setModel($model);

        $request = $provider->getRequest($action);

        $form = $provider->getForm(
            $action,
            $this->getEditActionFormOptions($model),
            $this->getEditActionFormData($model)
        );

        event(
            new ResourceRequested(
                $this->getPrefix(),
                $this->getResource(),
                $action,
                $model->getAttributes(),
                $request->all()
            )
        );

        $data = array_merge(
            compact('title', 'form', 'model'),
            $this->getEditViewData($model),
            $this->getDefaultViewData()
        );

        return view($this->getEditViewName(), $data);
    }

    /**
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store()
    {
        $action = 'store';

        $provider = $this->getResourceProvider();

        $request = $provider->getRequest($action);

        $this->validate($request, $request->rules(), $request->messages());

        $attributes = $request->transform($action);

        $model = $this->repository
            ->create($attributes);

        $model->updateRelations($attributes);

        event(
            new ResourceStored(
                $this->getPrefix(),
                $this->getResource(),
                $action,
                $model->getAttributes(),
                $request->all()
            )
        );

        return $this->respondWithSuccess(
            $this->getResponseHelper($action)
                ->setUrl($this->getRedirectUrl($action, $model))
                ->returnBack($this->shouldReturnBack($action, $request)),
            $this->getResponseExtraData($action, $model, $request)
        );
    }

    /**
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update()
    {
        $action = 'update';

        $id = $this->getResourceId();

        $old = $this->repository
            ->with($this->getWith($action))
            ->scopeQuery($this->getScope($action))
            ->find($id);

        $provider = $this->getResourceProvider()->setModel($old);

        $request = $provider->getRequest($action);

        $this->validate($request, $request->rules(), $request->messages());

        $attributes = $request->transform($action);

        $model = $this->repository->update($attributes, $id);

        $model->updateRelations($attributes);

        event(
            new ResourceUpdated(
                $this->getPrefix(),
                $this->getResource(),
                $action,
                $model->getAttributes(),
                $request->all(),
                $old->getAttributes()
            )
        );

        return $this->respondWithSuccess(
            $this->getResponseHelper($action)
                ->setUrl($this->getRedirectUrl($action, $model))
                ->returnBack($this->shouldReturnBack($action, $request)),
            $this->getResponseExtraData($action, $model, $request)
        );
    }

    /**
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy()
    {
        $action = 'destroy';

        $id = $this->getResourceId();

        $model = $this->repository
            ->with($this->getWith($action))
            ->scopeQuery($this->getScope($action))
            ->find($id);

        $provider = $this->getResourceProvider()->setModel($model);

        $request = $provider->getRequest($action);

        if ($request->get('_force', false) == true) {

            $this->repository->destroy($id);

            event(
                new ResourceDestroyed(
                    $this->getPrefix(),
                    $this->getResource(),
                    $action,
                    $model ? $model->getAttributes() : [],
                    $request->all()
                )
            );
        } else {
            $action = 'trash';

            $this->repository->trash($id);

            event(
                new ResourceTrashed(
                    $this->getPrefix(),
                    $this->getResource(),
                    $action,
                    $model ? $model->getAttributes() : [],
                    $request->all()
                )
            );
        }

        return $this->respondWithSuccess(
            $this->getResponseHelper($action)
                ->setUrl($this->getRedirectUrl($action, $model))
                ->returnBack($this->shouldReturnBack($action, $request)),
            $this->getResponseExtraData($action, $model, $request)
        );
    }

    /**
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function restore()
    {
        $action = 'restore';

        $id = $this->getResourceId();;

        $model = $this->repository
            ->with($this->getWith($action))
            ->scopeQuery($this->getScope($action))
            ->find($id);

        $provider = $this->getResourceProvider()->setModel($model);

        $request = $provider->getRequest($action);

        if ($this->repository->restore($id)) {
            $model = $this->repository->find($id);
        }

        event(
            new ResourceRestored(
                $this->getPrefix(),
                $this->getResource(),
                $action,
                $model->getAttributes(),
                $request->all()
            )
        );

        return $this->respondWithSuccess(
            $this->getResponseHelper($action)
                ->setUrl($this->getRedirectUrl($action, $model))
                ->returnBack($this->shouldReturnBack($action, $request)),
            $this->getResponseExtraData($action, $model, $request)
        );
    }
}
