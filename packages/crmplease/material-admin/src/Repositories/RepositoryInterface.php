<?php

namespace Crmplease\MaterialAdmin\Repositories;

interface RepositoryInterface extends \Prettus\Repository\Contracts\RepositoryInterface
{
	/**
	 * Retrieve first data of repository
	 *
	 * @param array $columns
	 *
	 * @return mixed
	 */
	public function first($columns = ['*']);

	/**
	 * Find first entity matching constraints.
	 *
	 * @param array $where
	 * @param array $columns
	 * @return mixed
	 */
	public function firstWhere(array $where, $columns = ['*']);

	/**
	 * Find data by multiple fields with limit
	 *
	 * @param array $where
	 * @param integer $limit
	 * @param array $columns
	 *
	 * @return mixed
	 */
	public function findWhereLimit(array $where, $limit, $columns = ['*']);

	/**
	 * Find first entity matching constraints or create them.
	 *
	 * @param array $attributes
	 * @return mixed
	 */
	public function firstOrCreate(array $attributes = []);

	/**
	 * Find last entity matching constraints.
	 *
	 * @param array $where
	 * @param array $columns
	 *
	 * @return mixed
	 */
	public function lastWhere(array $where, $columns = ['*']);

	/**
	 * Count entities in a storage by conditions.
	 *
	 * @param array $where
	 *
	 * @return mixed
	 */
	public function countWhere(array $where);

	/**
	 * Destroy an entity completely.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function destroy($id);

	/**
	 * Destroy entities completely by a condition.
	 *
	 * @param array $where
	 * @return mixed
	 */
	public function destroyWhere(array $where);

	/**
	 * Destroy data by multiple values in one field
	 *
	 * @param       $field
	 * @param array $values
	 *
	 * @return mixed
	 */
	public function destroyWhereIn($field, array $values);

	/**
	 * Destroy data by excluding multiple values in one field
	 *
	 * @param       $field
	 * @param array $values
	 *
	 * @return mixed
	 */
	public function destroyWhereNotIn($field, array $values);

	/**
	 * Move an entity to trash.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function trash($id);

	/**
	 * Move entities to trash by a condition.
	 *
	 * @param array $where
	 * @return mixed
	 */
	public function trashWhere(array $where);

	/**
	 * Trash data by multiple values in one field
	 *
	 * @param       $field
	 * @param array $values
	 *
	 * @return mixed
	 */
	public function trashWhereIn($field, array $values);

	/**
	 * Trash data by excluding multiple values in one field
	 *
	 * @param       $field
	 * @param array $values
	 *
	 * @return mixed
	 */
	public function trashWhereNotIn($field, array $values);

	/**
	 * Restore an entity from trash.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function restore($id);

	/**
	 * Restore entities from trash.
	 *
	 * @param array $where
	 * @return mixed
	 */
	public function restoreWhere(array $where);

	/**
	 * Restore data by multiple values in one field
	 *
	 * @param       $field
	 * @param array $values
	 *
	 * @return mixed
	 */
	public function restoreWhereIn($field, array $values);

	/**
	 * Restore data by excluding multiple values in one field
	 *
	 * @param       $field
	 * @param array $values
	 *
	 * @return mixed
	 */
	public function restoreWhereNotIn($field, array $values);

	/**
	 * Update or create an entity.
	 *
	 * @param array $attributes
	 * @param array $values
	 *
	 * @return mixed
	 */
	public function updateOrCreate(array $attributes, array $values = []);

	/**
	 * Update entities by a condition.
	 *
	 * @param array $where
	 * @param array $attributes
	 *
	 * @return mixed
	 */
	public function updateWhere(array $where, array $attributes);

	/**
	 * Update a limited number of entities by a condition.
	 *
	 * @param array $where
	 * @param array $attributes
	 * @param integer $limit
	 *
	 * @return mixed
	 */
	public function updateWhereLimit(array $where, array $attributes, $limit);

    /**
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|null $query
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function getDatatablesQuery($query = null);
}
