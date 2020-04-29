<?php namespace Crmplease\MaterialAdmin\DataTables\Html;

use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;

class Builder extends \Yajra\DataTables\Html\Builder
{
    /**
     * @var string
     */
    protected $translationNamespace;

    /**
     * @var string
     */
    protected $translationPrefix;

    /**
     * @var Collection
     */
    public $filters;

    /**
     * @var array
     */
    protected $filterAttributes = [];

    /**
     * @param Repository $config
     * @param Factory $view
     * @param HtmlBuilder $html
     */
    public function __construct(Repository $config, Factory $view, HtmlBuilder $html)
    {
        parent::__construct($config, $view, $html);

        $this->filters = new Collection;
        $this->filterAttributes = $this->config->get('datatables-html.filter', []);
    }

    /**
     * Get resource translation namespace.
     *
     * @return string
     */
    public function getTranslationNamespace()
    {
        return $this->translationNamespace;
    }

    /**
     * @param $translationNamespace
     * @return $this
     */
    public function setTranslationNamespace($translationNamespace)
    {
        $this->translationNamespace = $translationNamespace;

        return $this;
    }

    /**
     * Get resource translation prefix.
     *
     * @return string
     */
    public function getTranslationPrefix()
    {
        return $this->translationPrefix;
    }

    /**
     * @param $translationPrefix
     * @return $this
     */
    public function setTranslationPrefix($translationPrefix)
    {
        $this->translationPrefix = $translationPrefix;

        return $this;
    }

    /**
     * Get collection of columns.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFilterColumns()
    {
        return $this->filters;
    }

    /**
     * @param $classname
     *
     * @return $this
     */
    public function setFilterClass($classes)
    {
        $this->setFilterAttribute('class', $classes);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilterClass()
    {
        return $this->getFilterAttribute('class');
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setFilterId($id)
    {
        $this->setFilterAttribute('id', $id);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilterId()
    {
        return $this->getFilterAttribute('id');
    }

    /**
     * Sets filter attribute(s).
     *
     * @param string|array $attribute
     * @param mixed $value
     *
     * @return $this
     */
    public function setFilterAttribute($attribute, $value = null)
    {
        if (is_array($attribute)) {
            $this->setFilterAttributes($attribute);
        } else {
            $this->filterAttributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * Sets multiple filter attributes at once.
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function setFilterAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->setFilterAttribute($attribute, $value);
        }

        return $this;
    }

    /**
     * Retrieves filter attribute value.
     *
     * @param string $attribute
     *
     * @return mixed
     */
    public function getFilterAttribute($attribute)
    {
        if (!array_key_exists($attribute, $this->filterAttributes)) {
            return null;
        }

        return $this->filterAttributes[$attribute];
    }

    /**
     * @param $classname
     *
     * @return $this
     */
    public function setTableClass($classes)
    {
        $this->setTableAttribute('class', $classes);

        return $this;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setTableId($id)
    {
        $this->setTableAttribute('id', $id);

        return $this;
    }

    /**
     * Get translated column label.
     *
     * @param string $field
     *
     * @return string
     */
    protected function getColumnTranslationPrefix($column)
    {
        return sprintf('%s%s.columns.%s', $this->getTranslationNamespace(), $this->getTranslationPrefix(), $column);
    }

    /**
     * Get translated filter label.
     *
     * @param string $field
     *
     * @return string
     */
    protected function getFilterTranslationPrefix($column)
    {
        return sprintf('%s%s.filters.%s', $this->getTranslationNamespace(), $this->getTranslationPrefix(), $column);
    }

    /**
     * Convert string into a readable title.
     *
     * @param string $title
     *
     * @return string
     */
    public function getColumnTitle($column)
    {
        return trans($this->getColumnTranslationPrefix($column));
    }

    /**
     * Convert string into a readable title.
     *
     * @param string $title
     *
     * @return string
     */
    public function getFilterTitle($column)
    {
        return trans($this->getFilterTranslationPrefix($column));
    }

    /**
     * Set title attribute of an array if not set.
     *
     * @param string $title
     * @param array $attributes
     *
     * @return array
     */
    public function setTitle($column, array $attributes)
    {
        if (!isset($attributes['title'])) {
            $attributes['title'] = $this->getColumnTitle($column);
        }

        return $attributes;
    }

    /**
     * Set title attribute of an array if not set.
     *
     * @param string $title
     * @param array $attributes
     *
     * @return array
     */
    public function setFilterTitle($column, array $attributes)
    {
        if (!isset($attributes['title'])) {
            $attributes['title'] = $this->getFilterTitle($column);
        }

        return $attributes;
    }

    /**
     * Set datatables columns from array definition.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function columns(array $columns)
    {
        foreach ($columns as $key => $value) {
            if (!is_a($value, Column::class)) {
                if (is_array($value)) {
                    $attributes = array_merge(
                        [
                            'name' => $key,
                            'data' => $key,
                            'className' => sprintf('column column-%s', str_replace('.', '__', $key)),
                        ],
                        $this->setTitle($key, $value)
                    );
                } else {
                    $attributes = [
                        'name' => $value,
                        'data' => $value,
                        'className' => sprintf('column column-%s', str_replace('.', '__', $value)),
                        'title' => $this->getColumnTitle($value),
                    ];
                }

                $this->collection->push(new Column($attributes));
            } else {
                $this->collection->push($value);
            }
        }

        if (can_show_resource_action()) {
            $this->collection->push(
                new Column(
                    [
                        'name' => 'action',
                        'data' => 'action',
                        'className' => 'column column-action text-center',
                        'title' => trans('material-admin::datatables.columns.action'),
                        'orderable' => false,
                        'searchable' => false,
                        'exportable' => false,
                        'printable' => false,
                    ]
                )
            );
        }

        return $this;
    }

    /**
     * Set datatables filters from array definition.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function filters(array $columns)
    {
        foreach ($columns as $key => $value) {
            if (!is_a($value, FilterColumn::class)) {
                if (is_array($value)) {
                    $attributes = array_merge(
                        [
                            'name' => $key,
                            'data' => $key,
                            'type' => 'text',
                            'className' => sprintf('filter filter-%s', str_replace('.', '__', $key)),
                        ],
                        $this->setFilterTitle($key, $value)
                    );
                } else {
                    if (is_numeric($key)) {
                        $attributes = [
                            'name' => $value,
                            'data' => $value,
                            'type' => 'text',
                            'className' => sprintf('filter filter-%s', str_replace('.', '__', $value)),
                            'title' => $this->getFilterTitle($value),
                        ];
                    } else {
                        $attributes = [
                            'name' => $key,
                            'data' => $key,
                            'type' => $value,
                            'className' => sprintf('filter filter-%s', str_replace('.', '__', $key)),
                            'title' => $this->getFilterTitle($key),
                        ];
                    }
                }

                $this->filters->push(new FilterColumn($attributes));
            } else {
                $this->filters->push($value);
            }
        }

        return $this;
    }

    /**
     * Generate DataTable's filter html.
     *
     * @return string
     * @throws \Exception|\Throwable
     */
    public function form()
    {
        return view('datatables::filters')->with(
            [
                'id' => $this->getFilterId(),
                'class' => $this->getFilterClass(),
                'filters' => $this->getFilterColumns(),
            ]
        )->render();
    }
}
