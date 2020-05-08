<?php

namespace Crmplease\MaterialAdmin\Repositories;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class RepositoryEloquent
 *
 * @property \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\SoftDeletes $model
 * @package Crmplease\MaterialAdmin\Repositories
 */
abstract class RepositoryEloquent extends \Prettus\Repository\Eloquent\BaseRepository implements RepositoryInterface
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Add a relationship count / exists condition to the query with where clauses.
     *
     * @param string $relation
     * @param Closure|null $callback
     * @param string $operator
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function whereHas($relation, $callback = null, $operator = '>=', $count = 1)
    {
        $this->model = $this->model->whereHas($relation, $callback, $operator, $count);

        return $this;
    }

    /**
     * Find first entity matching constraints.
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function firstWhere(array $where, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->model = $this->buildWhereCondition($where);
        $model = $this->model->first($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Find first entity matching constraints or create them.
     *
     * @param array $attributes
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function firstOrCreate(array $attributes = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->model = $this->buildWhereCondition($attributes);
        $model = $this->model->firstOrCreate($attributes);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Find last entity matching constraints.
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function lastWhere(array $where, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->model = $this->buildWhereCondition($where);
        $model = $this->model->orderBy('id', 'desc')->first($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Count entities in a storage by conditions.
     *
     * @param array $where
     *
     * @return mixed
     */
    public function countWhere(array $where)
    {
        return $this->buildWhereCondition($where)->count();
    }

    /**
     * @param string $column
     * @param null $key
     *
     * @return array|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function lists($column, $key = null)
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->lists($column, $key);

        $this->resetModel();

        return $this->parserResult($results);
    }

    /**
     * Destroy an entity completely.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->withTrashed()->findOrFail($id)->forceDelete();
    }

    /**
     * Destroy entities completely by a condition.
     *
     * @param array $where
     *
     * @return mixed
     */
    public function destroyWhere(array $where)
    {
        return $this->buildWhereCondition($where)->withTrashed()->forceDelete();
    }

    /**
     * Move an entity to trash.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function trash($id)
    {
        return $this->delete($id);
    }

    /**
     * Move entities to trash by a condition.
     *
     * @param array $where
     *
     * @return mixed
     * @throws \Exception
     */
    public function trashWhere(array $where)
    {
        return $this->buildWhereCondition($where)->delete();
    }

    /**
     * Restore an entity from trash.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function restore($id)
    {
        return $this->model->withTrashed()->findOrFail($id)->restore();
    }

    /**
     * Restore entities from trash.
     *
     * @param array $where
     *
     * @return mixed
     */
    public function restoreWhere(array $where)
    {
        return $this->buildWhereCondition($where)->withTrashed()->restore();
    }

    /**
     * Find data by multiple fields with limit
     *
     * @param array $where
     * @param integer $limit
     * @param array $columns
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findWhereLimit(array $where, $limit, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }

        $model = $this->model->take($limit)->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Update entity by a condition.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return mixed
     */
    public function updateWhere(array $where, array $attributes)
    {
        return $this->buildWhereCondition($where)->update($attributes);
    }

    /**
     * Update a limited number of entities by a condition.
     *
     * @param array $where
     * @param array $attributes
     * @param integer $limit
     *
     * @return mixed
     */
    public function updateWhereLimit(array $where, array $attributes, $limit)
    {
        $ids = $this->buildWhereCondition($where)->take($limit)->pluck('id');

        return $this->model->whereIn('id', $ids)->update($attributes);
    }


    /**
     * Destroy data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroyWhereIn($field, array $values)
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->whereIn($field, $values)->forceDelete();

        $this->resetModel();

        return $result;
    }

    /**
     * Destroy data by excluding multiple values in one field
     *
     * @param       $field
     * @param array $values
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroyWhereNotIn($field, array $values)
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->whereNotIn($field, $values)->forceDelete();

        $this->resetModel();

        return $result;
    }

    /**
     * Trash data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function trashWhereIn($field, array $values)
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->whereIn($field, $values)->delete();

        $this->resetModel();

        return $result;
    }

    /**
     * Trash data by excluding multiple values in one field
     *
     * @param       $field
     * @param array $values
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function trashWhereNotIn($field, array $values)
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->whereNotIn($field, $values)->delete();

        $this->resetModel();

        return $result;
    }

    /**
     * Restore data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function restoreWhereIn($field, array $values)
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->whereIn($field, $values)->restore();

        $this->resetModel();

        return $result;
    }

    /**
     * Restore data by excluding multiple values in one field
     *
     * @param       $field
     * @param array $values
     *
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function restoreWhereNotIn($field, array $values)
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->whereNotIn($field, $values)->restore();

        $this->resetModel();

        return $result;
    }

    /**
     * Build where condition.
     *
     * @param array $where
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\SoftDeletes
     */
    protected function buildWhereCondition(array $where)
    {
        $query = $this->model->newQuery();

        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;

                if ($condition === 'in') {
                    $query->whereIn($field, $val);
                } else {
                    $query->where($field, $condition, $val);
                }
            } else {
                $query->where($field, '=', $value);
            }
        }

        return $query;
    }

    /**
     * ToDo: refactor trashed
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function getDatatablesQuery($query = null)
    {
        if (is_null($query)) {
            $query = $this->model->newQuery();
        }

        $query->select(
            sprintf('%s.*', $query->getModel()->getTable())
        );

        if (is_trashed_page()) {
            $query->onlyTrashed();
        }

        return $query;
    }
}
