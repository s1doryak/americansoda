<?php namespace Crmplease\MaterialAdmin\DataTables;

use DB;
use Crmplease\MaterialAdmin\DataTables\Contracts\AggregateContract;
use Crmplease\MaterialAdmin\DataTables\Contracts\FilterableContract;
use Crmplease\MaterialAdmin\DataTables\Traits\AggregateDataTable;
use Crmplease\MaterialAdmin\DataTables\Traits\FilterableDataTable;
use Crmplease\MaterialAdmin\DataTables\Utilities\Request;
use Illuminate\Support\Arr;

class EloquentDataTable extends \Yajra\DataTables\EloquentDataTable implements AggregateContract, FilterableContract
{
    use AggregateDataTable, FilterableDataTable;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var array
     */
    protected $aggregateColumns = [];

    /**
     * @var array
     */
    protected $aggregate;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $aggregateQuery;

    /**
     * @var array
     */
    protected $filterableColumns = [];

    /**
     * @var array
     */
    protected $filterable;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $filterableQuery;

    /**
     * @param string $column
     * @param string|null $table
     * @return string
     * @throws \Yajra\DataTables\Exceptions\Exception
     */
    public function joinFilterColumn($column, $table = null)
    {
        $parts = explode('.', $column);

        if (count($parts) > 1) {
            $relationColumn = array_pop($parts);
            $relation = implode('.', $parts);

            if (is_null($table)) {
                /**
                 * TODO: Переработать механизм фильтрации и агрегации.
                 * Вызов данного метода (во время фильтрации и агрегации) выполняет объединение таблиц,
                 * но при этом модифицирует исходный запрос,
                 * из-за чего запрос для агрегации данных содержит паразитные выборки и объединения.
                 */
                $column = $this->joinEagerLoadedColumn($relation, $relationColumn);
            } else {
                $column = sprintf('%s.%s', $table, $relationColumn);
            }
        } else {
            if (is_null($table)) {
                $column = sprintf('%s.%s', $this->query->getModel()->getTable(), $column);
            } else {
                $column = sprintf('%s.%s', $table, $column);
            }
        }

        return $column;
    }

    /**
     * Filter callback.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $builder
     *
     * @throws \Yajra\DataTables\Exceptions\Exception
     */
    public function filterCallback($builder)
    {
        foreach ($this->filterableColumns as $index => $column) {

            if (is_array($column)) {
                $name = Arr::get($column, 'name', $index);
                $data = Arr::get($column, 'data', $name);
                $type = Arr::get($column, 'type', null);
                $operator = Arr::get($column, 'operator', null);
                $default = Arr::get($column, 'default', null);
                $query = Arr::get($column, 'query', null);
            } else {
                if (is_numeric($index)) {
                    $name = $column;
                    $data = $name;
                    $type = null;
                    $operator = null;
                    $default = null;
                    $query = null;
                } else {
                    $name = $index;
                    $data = $name;
                    $type = null;
                    $operator = null;
                    $default = null;
                    $query = null;
                }
            }

            $value = $this->request->filterValueByName($name, $default);

            if (is_null($value)) {
                continue;
            }

            $filterColumn = $this->joinFilterColumn($data);

            if ($query instanceof \Closure) {
                call_user_func_array($query, [&$builder, $filterColumn, $value]);
            } else {
                switch ($operator) {
                    case 'in':
                        $builder->whereIn($filterColumn, Arr::wrap($value));
                        break;
                    case 'not_in':
                        $builder->whereNotIn($filterColumn, Arr::wrap($value));
                        break;
                    case 'null':
                        $builder->whereNull($filterColumn);
                        break;
                    case 'not_null':
                        $builder->whereNotNull($filterColumn);
                        break;
                    default:
                        switch ($type) {
                            case 'datepicker':
                                $dates = collect(explode(' - ', $value));

                                $builder->whereRaw(
                                    DB::raw(
                                        sprintf(
                                            "%s BETWEEN STR_TO_DATE('%s 00:00:00', '%s') AND STR_TO_DATE('%s 23:59:59', '%s')",
                                            $filterColumn,
                                            $dates->first(),
                                            '%d/%m/%Y %H:%i:%s',
                                            $dates->last(),
                                            '%d/%m/%Y %H:%i:%s'
                                        )
                                    )
                                );
                                break;
                            default:
                                $builder->where([$filterColumn => $value]);
                                break;
                        }
                }
            }
        }
    }

    /**
     * Prepare query by executing count, filter, order and paginate.
     */
    protected function prepareQuery()
    {
        /**
         * Сценарий работы:
         * 1. Узнать количество строк в таблице. Необходимо для дальнейшей пагинации.
         * 2. Собрать уникальные варианты значений для фильтров - во всей таблице.
         * 3. Применить фильтры.
         * 4. Выполнить агрегацию данных на отфильтрованных строках.
         * 5. Применить сортировку на отфильтрованных строках.
         * 6. Применить пагинацию на отфильтрованных строках.
         */
        if (!$this->prepared) {
            $this->totalRecords = $this->totalCount();

            $this->filterable();

            if ($this->totalRecords) {
                $this->filterRecords();
            }

            $this->aggregate();

            if ($this->totalRecords) {
                $this->ordering();
                $this->paginate();
            }
        }

        $this->prepared = true;
    }

    /**
     * Prepare count query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    protected function prepareCountQuery()
    {
        $builder = clone $this->query;

        /**
         * TODO: Временное решение против паразитных объединений.
         * Из-за этого некорректно работает агрегация (во все поля добавляется distinct).
         * @see joinFilterColumn()
         */
        $builder->distinct();

        if (!$this->isComplexQuery($builder)) {
            $row_count = $this->wrap('row_count');
            $builder->select($this->connection->raw("'1' as {$row_count}"));
            if (!$this->keepSelectBindings) {
                $builder->setBindings([], 'select');
            }
        }

        return $builder;
    }

    /**
     * Get paginated results.
     *
     * @return \Illuminate\Support\Collection
     */
    public function results()
    {
        /**
         * TODO: Временное решение против паразитных объединений.
         * Из-за этого некорректно работает агрегация (во все поля добавляется distinct.
         * @see joinFilterColumn()
         */
        return $this->query->distinct()->get();
    }
}
