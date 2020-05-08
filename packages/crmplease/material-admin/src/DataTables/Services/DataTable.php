<?php

namespace Crmplease\MaterialAdmin\DataTables\Services;

use Gate;
use Crmplease\MaterialAdmin\DataTables\Traits\RenderHelpers;
use Crmplease\MaterialAdmin\DataTables\DataTables;
use Crmplease\MaterialAdmin\DataTables\Html\Column;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class DataTable
 *
 * @property string $prefix
 * @property string $resource
 * @property string $translationNamespace
 * @property string $translationPrefix
 * @property string $viewNamespace
 * @property string $viewPrefix
 * @property \Crmplease\MaterialAdmin\Repositories\RepositoryInterface $repository
 * @property \Illuminate\Contracts\Auth\StatefulGuard $guard
 */
class DataTable extends \Yajra\DataTables\Services\DataTable
{
    use RenderHelpers;

    /**
     * Define the table control elements to appear on the page and in what order.
     * @see https://datatables.net/reference/option/dom
     * @var string
     */
    protected $dom = 'l<"dataTables_buttons"B>ftip';

    /**
     * Enable and configure the Responsive extension for DataTables.
     * @see https://datatables.net/reference/option/responsive
     * @var boolean
     */
    protected $responsive = true;

    /**
     * Enable or disable table pagination.
     * @see https://datatables.net/reference/option/paging
     * @var boolean
     */
    protected $paging = true;

    /**
     * This option allows the search abilities of DataTables to be enabled or disabled.
     * @see https://datatables.net/reference/option/searching
     * @var boolean
     */
    protected $searching = true;

    /**
     * Feature control the processing indicator.
     * @see https://datatables.net/reference/option/processing
     * @var boolean
     */
    protected $processing = true;

    /**
     * State saving - restore table state on page reload.
     * @see https://datatables.net/reference/option/stateSave
     * @var boolean
     */
    protected $stateSave = true;

    /**
     * State save - data manipulation callback.
     * @see https://datatables.net/reference/option/stateSaveParams
     * @var string
     */
    protected $stateSaveParams = "function (settings, data) { data.search.search = ''; }";

    /**
     * @return string
     */
    protected function getDom()
    {
        return $this->dom;
    }

    /**
     * @return boolean
     */
    protected function getResponsive()
    {
        return $this->responsive;
    }

    /**
     * @return boolean
     */
    protected function getPaging()
    {
        return $this->paging;
    }

    /**
     * @return boolean
     */
    protected function getSearching()
    {
        return $this->searching;
    }

    /**
     * @return boolean
     */
    protected function getProcessing()
    {
        return $this->processing;
    }

    /**
     * @return boolean
     */
    protected function getStateSave()
    {
        return $this->stateSave;
    }

    /**
     * @return string
     */
    protected function getStateSaveParams()
    {
        return $this->stateSaveParams;
    }

    /**
     * @param $action
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @return boolean
     */
    protected function can($action, $model = null)
    {
        if (is_null($model)) {
            $model = $this->repository->model();
        }

        switch ($action) {
            case 'show':
                $action = 'view';
                break;
            case 'edit':
                $action = 'update';
                break;
            default:
                break;
        }

        $policy = sprintf('%s-%s', $action, $this->resource);

        if (Gate::getPolicyFor($model)) {
            return Gate::allows($action, $model);
        } elseif (Gate::has($policy)) {
            return Gate::allows($policy, $model);
        } else {
            return true;
        }
    }

    /**
     * @return string
     */
    protected function getTableId()
    {
        return Str::camel(sprintf('%s_datatable', $this->resource));
    }

    /**
     * @return string
     */
    protected function getTableClass()
    {
        return 'table table-striped responsive';
    }

    /**
     * @return string
     */
    protected function getFilterId()
    {
        return Str::camel(sprintf('%s_datatable_filter', $this->resource));
    }

    /**
     * @return string
     */
    protected function getFilterClass()
    {
        return 'form-horizontal dataTableFilter';
    }

    /**
     * @return string
     */
    protected function getTranslationNamespace()
    {
        return $this->translationNamespace;
    }

    /**
     * @return string
     */
    protected function getTranslationPrefix()
    {
        return $this->translationPrefix;
    }

    /**
     * @return array
     */
    protected function getButtons()
    {
        $buttons = [];

        if ($this->can('index') && is_trashed_page()) {
            $buttons[] = [
                'extend' => 'link',
                'className' => 'btn-icon-text btn-primary',
                'text' => '<i class="zmdi zmdi-hc-fw zmdi-arrow-left"></i>' . trans("{$this->translationNamespace}{$this->translationPrefix}.labels.plural"),
                'url' => route("{$this->prefix}.{$this->resource}.index"),
            ];
        }

        if ($this->can('create') && !is_trashed_page()) {
            $buttons[] = [
                'extend' => 'action',
                'className' => 'btn-icon-text btn-primary',
                'text' => trans('material-admin::datatables.buttons.create'),
                'attr' => [
                    'data-role' => 'action',
                    'data-action' => 'create',
                    'data-resource' => $this->resource,
                    'data-url' => route("{$this->prefix}.{$this->resource}.create"),
                    'data-method' => 'GET',
                    'data-token' => csrf_token(),
                    'data-icon-class' => 'zmdi-plus',
                    'data-progress-icon-class' => 'zmdi-spinner zmdi-hc-spin',
                ]
            ];
        }

        $buttons[] = [
            'extend' => 'reload',
            'className' => 'btn-icon-text',
            'text' => trans('material-admin::datatables.buttons.reload'),
        ];

        if ($this->can('trashed') && !is_trashed_page()) {
            $buttons[] = [
                'extend' => 'trashed',
                'className' => 'btn-icon-text',
                'text' => trans('material-admin::datatables.buttons.trashed'),
            ];
        }

        if ($this->can('export')) {
            $buttons[] = [
                'extend' => 'collection',
                'text' => trans('material-admin::datatables.buttons.export'),
                'autoClose' => true,
                'buttons' => [
                    [
                        'extend' => 'excel',
                        'text' => trans('material-admin::datatables.buttons.excel'),
                    ],
                    [
                        'extend' => 'pdf',
                        'text' => trans('material-admin::datatables.buttons.pdf'),
                    ],
                    [
                        'extend' => 'print',
                        'text' => trans('material-admin::datatables.buttons.print'),
                    ],
                ],
            ];
        }

        $buttons[] = [
            'extend' => 'colvis',
            'className' => 'btn-icon-text',
            'text' => trans('material-admin::datatables.buttons.colvis'),
            'autoClose' => true,
        ];

        if (count($this->getFilterableColumns())) {
            $buttons[] = [
                'extend' => 'filter',
                'className' => 'btn-icon-text',
                'text' => trans('material-admin::datatables.buttons.filter'),
            ];
        }

        return $buttons;
    }

    /**
     * Get default row attributes.
     */
    protected function getRowAttributes()
    {
        return [
            'data-id' => function ($model) {
                return $model->getKey();
            },
            'data-trashed' => function ($model) {
                return $model->trashed() ? 'true' : 'false';
            },
        ];
    }

    /**
     * Get language settings
     * @return mixed
     */
    protected function getLanguage()
    {
        $language = [];

        $locales = config('locales', []);

        $languages = config('datatables-i18n', []);

        $locale = config('app.locale');

        if (isset($locales[$locale])) {
            if (isset($languages[$languages[$locale]])) {
                $language['url'] = $languages[$languages[$locale]];
            } else {
                if (isset($languages[$locale])) {
                    $language['url'] = $languages[$locale];
                }
            }
        } else {
            if (isset($languages[$locale])) {
                $language['url'] = $languages[$locale];
            }
        }

        return $language;
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getRawColumns()
    {
        return config('datatables.columns.raw', []);
    }

    /**
     * Aggregate columns configuration array.
     *
     * Default aggregate function: sum.
     *
     * Example:
     *
     *  'total',
     *  'price',
     *
     * or type specific:
     *
     *  'total' => 'sum',
     *  'price' => 'avg',
     *
     * or advanced configuration:
     *
     *  'total' => [
     *      'data' => 'another_column',
     *      'function' => 'sum',
     *      'distinct' => true,
     *      'format' => '%.02f %s',
     *      'format_args' => ['₽'],
     *  ],
     *  'price' => [
     *      'data' => 'price',
     *      'function' => 'sum',
     *      'format' => function($aggregate, $arg) {
     *          return sprintf("~%s %s", number_format($aggregate), $arg);
     *      },
     *      'format_args' => ['₽'],
     *  ],
     *
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [];
    }

    /**
     * Filter columns configuration array.
     *
     * Available types: text (default), checkbox, choice, datepicker.
     * Compare operators: = (default), in, not_in, null, not_null
     *
     * Example:
     *
     *  'status',
     *  'event.name',
     *
     * or type specific:
     *
     *  'date' => 'datepicker',
     *  'event.name' => 'choice'
     *
     * or advanced configuration:
     *
     *  'date' => [
     *      'type' => 'datepicker',
     *      'default' => '01/01/2019 - 31/12/2019'
     *  ],
     *  'event.name' => [
     *      'type' => 'choice',
     *      'multiple' => true,
     *      'operator' => 'in',
     *      'data' => 'event.id',
     *      'lists' => 'event.name',
     *  ],
     *  'status' => [
     *      'type' => 'checkbox',
     *      'default' => 'done',
     *      'attr' => [
     *          'ts-color' => 'green',
     *          'ts-label' => 'Done',
     *      ]
     *  ],
     *
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [];
    }

    /**
     * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model $model
     * @return array
     */
    protected function getDefaultActions($model)
    {
        return [
            'show' => [
                'resource' => $this->resource,
                'url' => route("{$this->prefix}.{$this->resource}.show", $model->getKey()),
                'target' => '_blank',
                'icon' => 'eye',
                'color' => 'primary',
                'title' => trans("{$this->translationNamespace}{$this->translationPrefix}.show.title"),
            ],
            'edit' => [
                'resource' => $this->resource,
                'url' => route("{$this->prefix}.{$this->resource}.edit", $model->getKey()),
                'target' => '_self',
                'icon' => 'edit',
                'color' => 'green',
                'title' => trans("{$this->translationNamespace}{$this->translationPrefix}.edit.title"),
            ],
            'trash' => [
                'resource' => $this->resource,
                'url' => route("{$this->prefix}.{$this->resource}.destroy", $model->getKey()),
                'method' => 'delete',
                'params' => [
                    '_method' => 'delete',
                    '_token' => csrf_token(),
                ],
                'icon' => 'delete',
                'color' => 'red',
                'title' => trans("{$this->translationNamespace}{$this->translationPrefix}.trash.title"),
            ],
            'restore' => [
                'resource' => $this->resource,
                'url' => route("{$this->prefix}.{$this->resource}.restore", $model->getKey()),
                'method' => 'put',
                'params' => [
                    '_method' => 'put',
                    '_token' => csrf_token(),
                ],
                'icon' => 'undo',
                'color' => 'cyan',
                'title' => trans("{$this->translationNamespace}{$this->translationPrefix}.restore.title"),
            ],
            'destroy' => [
                'resource' => $this->resource,
                'url' => route("{$this->prefix}.{$this->resource}.destroy", $model->getKey()),
                'method' => 'delete',
                'params' => [
                    '_method' => 'delete',
                    '_token' => csrf_token(),
                    '_force' => true,
                ],
                'icon' => 'close-circle',
                'color' => 'red',
                'title' => trans("{$this->translationNamespace}{$this->translationPrefix}.destroy.title"),
            ],
        ];
    }

    /**
     * @param \Crmplease\MaterialAdmin\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model $model
     *
     * @return array
     */
    protected function getActions($model)
    {
        return $this->getDefaultActions($model);
    }

    /**
     * Get default builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'dom' => $this->getDom(),
            'responsive' => $this->getResponsive(),
            'paging' => $this->getPaging(),
            'processing' => $this->getProcessing(),
            'searching' => $this->getSearching(),
            'stateSave' => $this->getStateSave(),
            'stateSaveParams' => $this->getStateSaveParams(),
            'buttons' => $this->getButtons(),
            'language' => $this->getLanguage(),
            'drawCallback' => "function () {
                var json = this.api().ajax.json() || {};

                this.trigger('draw');

                if(json.error) {
                    this.trigger('error', [json.error]);
                }

                if(json.aggregate) {
                    this.trigger('aggregate', [json.aggregate]);
                }

                if(json.filterable) {
                    this.trigger('filterable', [json.filterable]);
                }
            }",
        ];
    }

    /**
     * Get default ajax parameters.
     *
     * @return array
     */
    protected function getAjaxParameters()
    {
        $appendScript = $this->getAjaxDataScript();

        return [
            'type' => 'POST',
            'data' => "function(data) {
                data._method = 'GET';
                ${appendScript}
            }",
        ];
    }

    /**
     * Get default ajax data script.
     *
     * @return string
     */
    protected function getAjaxDataScript()
    {
        if (count($this->getFilterableColumns())) {
            return "jQuery.extend(data, jQuery('.dataTableFilter').serializeObject());";
        }

        return "";
    }

    /**
     * @param \Crmplease\MaterialAdmin\DataTables\EloquentDataTable $dataTable
     * @return \Closure
     */
    protected function getFilter($dataTable)
    {
        return function ($query) use ($dataTable) {
            $dataTable->filterCallback($query);
        };
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Crmplease\MaterialAdmin\DataTables\Html\Builder
     */
    public function html()
    {
        /** @var \Crmplease\MaterialAdmin\DataTables\Html\Builder $builder */
        $builder = $this->builder();

        return $builder
            ->setTableId($this->getTableId())
            ->setTableClass($this->getTableClass())
            ->setFilterId($this->getFilterId())
            ->setFilterClass($this->getFilterClass())
            ->setTranslationNamespace($this->getTranslationNamespace())
            ->setTranslationPrefix($this->getTranslationPrefix())
            ->columns($this->getColumns())
            ->filters($this->getFilterableColumns())
            ->parameters($this->getBuilderParameters())
            ->ajax($this->getAjaxParameters());
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getDatatablesQuery();
    }

    /**
     * @param \Crmplease\MaterialAdmin\DataTables\DataTables $dataTables
     * @param \Illuminate\Database\Eloquent\Builder|mixed $query
     * @return \Crmplease\MaterialAdmin\DataTables\EloquentDataTable
     */
    public function dataTable(DataTables $dataTables, $query)
    {
        /** @var \Crmplease\MaterialAdmin\DataTables\EloquentDataTable $dataTable */
        $dataTable = $dataTables->eloquent($query);

        $dataTable->setRowAttr($this->getRowAttributes())
            ->aggregateColumns($this->getAggregateColumns())
            ->filterableColumns($this->getFilterableColumns())
            ->rawColumns($this->getRawColumns())
            ->filter($this->getFilter($dataTable), true);

        $columns = $this->builder()
            ->columns($this->getColumns())
            ->getColumns();

        foreach ($columns as $key => $value) {
            if (!is_a($value, Column::class)) {
                if (is_array($value)) {
                    $column = $key;
                    $template = Arr::get($value, 'template');
                } else {
                    $column = $value;
                    $template = null;
                }
            } else {
                $column = $value->name;
                $template = $value->template;
            }

            $method = str_replace('.', '__', Str::camel("render_{$column}_column"));

            if (method_exists($this, $method)) {
                $dataTable->editColumn(
                    $column,
                    function ($model) use ($method) {
                        return $this->{$method}($model);
                    }
                );
            } elseif (view()->exists($template)) {
                $dataTable->editColumn(
                    $column,
                    function ($model) use ($template, $column) {
                        return view()->make($template)->with(compact('model', 'column'))->render();
                    }
                );
            }
        }

        return $dataTable;
    }

    /**
     * @return boolean
     */
    protected function isDataTableRequest()
    {
        return $this->request()->ajax() && $this->request()->wantsJson();
    }

    /**
     * @return boolean
     */
    protected function isActionRequest()
    {
        return $action = $this->request()->get('action') and in_array($action, $this->actions);
    }

    /**
     * PDF version of the table using print preview blade template.
     *
     * @return mixed
     */
    public function snappyPdf()
    {
        return $this
            ->getSnappy()
            ->setOptions($this->getSnappyOptions())
            ->setOrientation($this->getSnappyOrientation())
            ->loadHTML($this->printPreview())
            ->download($this->getFilename() . '.pdf');
    }

    /**
     * @return \Barryvdh\Snappy\PdfWrapper
     */
    public function getSnappy()
    {
        return resolve('snappy.pdf.wrapper');
    }

    /**
     * @return array
     */
    public function getSnappyOptions()
    {
        return config('datatables-buttons.snappy.options');
    }

    /**
     * @return string
     */
    public function getSnappyOrientation()
    {
        return config('datatables-buttons.snappy.orientation');
    }
}
