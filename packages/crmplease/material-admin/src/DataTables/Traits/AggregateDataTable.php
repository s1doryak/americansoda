<?php namespace Crmplease\MaterialAdmin\DataTables\Traits;

use DB;
use Illuminate\Support\Arr;

/**
 * Trait AggregateDataTable
 * @property \Illuminate\Database\Connection $connection
 * @package Crmplease\MaterialAdmin\DataTables\Traits
 */
trait AggregateDataTable
{
    /**
     * @return void
     */
    public function aggregate()
    {
        $this->aggregate = [];

        foreach ($this->aggregateColumns as $index => $column) {

            $aggregate = [];

            if (is_array($column)) {
                $name = Arr::get($column, 'name', $index);
                $data = Arr::get($column, 'data', $name);
                $format = Arr::get($column, 'format', '%.02f');
                $format_args = (array)Arr::get($column, 'format_args', []);
                $function = Arr::get($column, 'function', 'sum');
                $distinct = Arr::get($column, 'distinct', false);
                $query = Arr::get($column, 'query', null);
            } else {
                if (is_numeric($index)) {
                    $name = $column;
                    $data = $name;
                    $format = '%.02f';
                    $format_args = [];
                    $function = 'sum';
                    $distinct = false;
                    $query = null;
                } else {
                    $name = $index;
                    $data = $name;
                    $format = '%.02f';
                    $format_args = [];
                    $function = $column;
                    $distinct = false;
                    $query = null;
                }
            }

            try {
                if ($data instanceof \Closure) {
                    $data = (string)call_user_func_array($data, [$name]);
                }

                /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $aggregateQuery */
                $aggregateQuery = clone $this->query;

                if ($query instanceof \Closure) {
                    call_user_func_array($query, [&$aggregateQuery, $data]);
                } else {
                    /**
                     * Временная мера, для удаления паразитных выборок.
                     * См. ниже: "Переработать механизм фильтрации и агрегации."
                     */
                    $aggregateQuery->select(
                        $this->joinFilterColumn($data)
                    );
                }

                $aggregateQueryColumnName = $this->joinFilterColumn($data, 'aggregate_table');
                $aggregateQueryColumn = DB::raw(
                    $distinct ?
                        sprintf('%s(distinct %s) as `aggregate`', $function, $aggregateQueryColumnName) :
                        sprintf('%s(%s) as `aggregate`', $function, $aggregateQueryColumnName)
                );

                $aggregateTable = $this->connection->raw('(' . $aggregateQuery->toSql() . ') aggregate_table');

                $results = $this->connection
                    ->table($aggregateTable)
                    ->select($aggregateQueryColumn)
                    ->setBindings($aggregateQuery->getBindings())
                    ->first();

                array_unshift($format_args, $results->aggregate);

                if ($format instanceof \Closure) {
                    $html = call_user_func_array($format, $format_args);
                } else {
                    $html = vsprintf($format, $format_args);
                }

                $aggregate['name'] = $name;
                $aggregate['data'] = $data;
                $aggregate['html'] = $html;

            } catch (\Exception $exception) {
                $aggregate['name'] = $name;
                $aggregate['data'] = $data;
                $aggregate['html'] = '&times;';
                $aggregate['exception'] = [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'code' => $exception->getCode(),
                    'trace' => $exception->getTrace()
                ];
            }

            $this->aggregate[] = $aggregate;

        }

        $this->with('aggregate', $this->aggregate);
    }

    /**
     * @param array $columns
     *
     * @return $this
     */
    public function aggregateColumns(array $columns = [])
    {
        $this->aggregateColumns = $columns;

        return $this;
    }
}
