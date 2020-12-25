<?php

namespace Crmplease\MaterialAdmin\Database\Eloquent;

use Carbon\Carbon;
use Crmplease\MaterialAdmin\Database\Eloquent\Traits\FileModel;
use Crmplease\MaterialAdmin\Database\Eloquent\Traits\ImageModel;
use Crmplease\MaterialAdmin\Database\Eloquent\Traits\PrettyModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Model extends \Illuminate\Database\Eloquent\Model implements Transformable
{
	use TransformableTrait, SoftDeletes, FileModel, ImageModel, PrettyModel;

	public static $snakeAttributes = false;

	public static $relationMethods = [
		'belongsTo',
		'belongsToMany',
		'hasOne',
		'hasMany',
		'hasManyThrough',
		'morphTo',
		'morphOne',
		'morphMany',
		'morphToMany',
		'morphedByMany',
	];

	protected $appends = [

	];

	protected $casts = [

	];

	protected $dates = [
		'deleted_at',
	];

	protected $images = [

	];

	protected $files = [

	];

	protected $belongsTo = [

	];

	protected $belongsToMany = [

	];

	protected $belongsToManyPivot = [

	];

	protected $belongsToManyPivotTimestamps = [

	];

	protected $hasOne = [

	];

	protected $hasMany = [

	];

	protected $hasManyThrough = [

	];

	protected $morphTo = [

	];

	protected $morphOne = [

	];

	protected $morphMany = [

	];

	protected $morphToMany = [

	];

	protected $morphedByMany = [

	];

	protected $with = [

	];

	/**
	 * Check whether the table has been already joined.
	 *
	 * @param $query
	 * @param string $table
	 *
	 * @return boolean
	 */
	public static function isJoined($query, $table)
	{
		$joins = $query->getQuery()->joins;

		if ($joins == null) {
			return false;
		}

		foreach ($joins as $join) {
			if ($join->table == $table) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Get the joining table name for a many-to-many relation.
	 *
	 * @param string $related
	 * @param \Illuminate\Database\Eloquent\Model|null $instance
	 * @return string
	 */
	public function joiningTable($related, $instance = null)
	{
		// The joining table name, by convention, is simply the snake cased models
		// sorted alphabetically and concatenated with an underscore, so we can
		// just sort the models and join them together to get the table name.
		$segments = [
			$instance ? $instance->joiningTableSegment()
				: Str::snake(class_basename($related)),
			$this->joiningTableSegment(),
		];

		$relatedMethod = Str::camel(Str::plural($related));

		if (isset($this->belongsToMany[$relatedMethod])) {

			$relatedMethodParams = $this->belongsToMany[$relatedMethod];

			if (is_array($relatedMethodParams)) {

				return $relatedMethodParams[1];

			}
		}

		// Now that we have the model names in an array we can just sort them and
		// use the implode function to join them together with an underscores,
		// which is typically used by convention within the database system.
		sort($segments);

		return strtolower(implode('_', $segments));
	}

	/**
	 * Check model has attribute.
	 *
	 * @param $attr
	 *
	 * @return boolean
	 */
	public function hasAttribute($attr)
	{
		return array_key_exists($attr, $this->attributes);
	}

	/**
	 * Get an attribute from the model.
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function getAttribute($key)
	{
		if (array_key_exists($key, $this->attributes) || $this->hasGetMutator($key)) {

			if (in_array($key, $this->files)) {

				return $this->getFileAttributeValue($key);
			}

			if (in_array($key, $this->images)) {

				return $this->getImageAttributeValue($key);
			}

			return $this->getAttributeValue($key);
		}

		if ($this->relationLoaded($key)) {
			return $this->relations[$key];
		}

		foreach (static::$relationMethods as $method) {
			if ($this->isRelationMethod($key, $method)) {
				return $this->callRelationMethod($key, $method, [])->getResults();
			}
		}

		if (in_array($key, static::$relationMethods)) {
			return isset($this->{$key}) ? (array)$this->{$key} : [];
		}

		if (method_exists($this, $key)) {
			return $this->getRelationshipFromMethod($key);
		}
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return $this
	 */
	public function setAttribute($key, $value)
	{
		if ($this->hasSetMutator($key)) {
			$method = Str::camel(sprintf('set_%s_attribute', $key));

			return $this->{$method}($value);
		}

		if (in_array($key, $this->dates)) {
			if ($value) {
				if ($value instanceof Carbon) {
					$this->attributes[$key] = $value;
				} elseif ($value instanceof \DateTime) {
					$this->attributes[$key] = Carbon::instance($value);
				} else {
					$this->attributes[$key] = Carbon::parse($value);
				}

			} else {
				$this->attributes[$key] = null;
			}

			return $this;
		}

		if (in_array($key, $this->files)) {
			return $this->setFileAttributeValue($key, $value);
		}

		if (in_array($key, $this->images)) {
			return $this->setImageAttributeValue($key, $value);
		}

		if ($this->hasCast($key)) {
			switch ($this->getCastType($key)) {
				case 'float':
					$this->attributes[$key] = floatize($value);
					return $this;
				case 'integer':
					$this->attributes[$key] = numerize($value);
					return $this;
				case 'boolean':
					$this->attributes[$key] = booleanize($value);
					return $this;
			}
		}

		return parent::setAttribute($key, $value);
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		$attributes = parent::toArray();

		foreach ($attributes as $key => $value) {

			if (in_array($key, $this->files)) {

				if (!empty($value)) {
					$attributes[$key] = json_decode($value, true);
				}
			}

			if (in_array($key, $this->images)) {

				if (!empty($value)) {
					$attributes[$key] = json_decode($value, true);
				}
			}
		}

		return $attributes;
	}

	/**
	 * Handle dynamic method calls into the model.
	 *
	 * @param string $method
	 * @param array $parameters
	 *
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		foreach (static::$relationMethods as $relationMethod) {
			if ($this->isRelationMethod($method, $relationMethod)) {
				return $this->callRelationMethod($method, $relationMethod, $parameters);
			}
		}

		if (in_array($method, ['increment', 'decrement'])) {
			return call_user_func_array([$this, $method], $parameters);
		}

		$query = $this->newQuery();

		return call_user_func_array([$query, $method], $parameters);
	}

	/**
	 * Invoke dynamic relation method.
	 *
	 * @param string $relation
	 * @param string $method
	 * @param array $parameters
	 *
	 * @return mixed
	 */
	private function callRelationMethod($relation, $method, array $parameters = [])
	{
		$methods = [
			'belongsTo',
			'belongsToMany',
			'hasOne',
			'hasMany',
			'hasManyThrough',
			'morphTo',
			'morphOne',
			'morphMany',
			'morphToMany',
			'morphedByMany'
		];

		if (in_array($method, $methods)) {

			$parameters = call_user_func_array(
				[$this, 'build' . ucfirst($method) . 'Parameters'],
				[$relation, isset($this->{$method}[$relation]) ? (array)$this->{$method}[$relation] : []]
			);
		}

		$relationResult = call_user_func_array([$this, $method], $parameters);
		$relationResult = call_user_func([$relationResult, 'withTrashed']);

		if (in_array($method, ['belongsToMany'])) {
			if (isset($this->belongsToManyPivot[$relation])) {
				$relationResult = call_user_func_array(
					[$relationResult, 'withPivot'],
					(array)$this->belongsToManyPivot[$relation]
				);
			}

			if (in_array($relation, $this->belongsToManyPivotTimestamps)) {
				$relationResult = call_user_func(
					[$relationResult, 'withTimestamps']
				);
			}
		}

		return $relationResult;
	}

	/**
	 * Build 'belongsTo' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildBelongsToParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], null, null, $relation]
		);
	}

	/**
	 * Build 'belongsToMany' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildBelongsToManyParameters($relation, array $parameters)
	{
		$table = sprintf('%s_%s', Str::singular($this->getTable()), Str::singular(Str::snake($relation)));

		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], $table, null, null, null]
		);
	}

	/**
	 * Build 'hasOne' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildHasOneParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], null, null]
		);
	}

	/**
	 * Build 'hasMany' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildHasManyParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], null, null]
		);
	}

	/**
	 * Build 'hasManyThrough' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildHasManyThroughParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], null, null]
		);
	}

	/**
	 * Build 'morphTo' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildMorphToParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$relation, null, null]
		);
	}

	/**
	 * Build 'morphOne' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildMorphOneParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], sprintf('%sable', Str::singular($relation)), null, null, null]
		);
	}

	/**
	 * Build 'morphMany' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildMorphManyParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], sprintf('%sable', Str::singular($relation)), null, null, null]
		);
	}

	/**
	 * Build 'morphToMany' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildMorphToManyParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], sprintf('%sable', Str::singular($relation)), null, null, null]
		);
	}

	/**
	 * Build 'morphedByMany' method parameters.
	 *
	 * @param string $relation
	 * @param array $parameters
	 *
	 * @return array
	 */
	private function buildMorphedByManyParameters($relation, array $parameters)
	{
		return $this->buildRelationMethodParameters(
			$parameters,
			[$parameters[0], sprintf('%sable', Str::singular($relation)), null, null, null]
		);
	}

	/**
	 * Build parameters array for the called relation method.
	 *
	 * @param array $parameters
	 * @param array $defaults
	 *
	 * @return array
	 */
	private function buildRelationMethodParameters(array $parameters = [], array $defaults = [])
	{
		foreach ($defaults as $key => $value) {
			$parameters[$key] = isset($parameters[$key]) ? $parameters[$key] : $value;
		}

		return $parameters;
	}

	/**
	 * Check whether called method is a relation.
	 *
	 * @param string $relation
	 * @param string $method
	 *
	 * @return boolean
	 */
	private function isRelationMethod($relation, $method)
	{
		return property_exists($this, $method) && (array_key_exists($relation, $this->{$method}) || in_array($relation, $this->{$method}));
	}

	/**
	 * Eager load relations on the model.
	 *
	 * @param array|string $relations
	 *
	 * @return $this
	 */
	public function lazyLoad($relations)
	{
		if (is_string($relations)) {
			$relations = func_get_args();
		}

		foreach ($relations as $relation) {
			if (!$this->relationLoaded($relation)) {
				$this->load($relation);
			}
		}

		return $this;
	}

	/**
	 * @return array
	 */
	public function getBelongsToRelations()
	{
		if (isset($this->belongsTo)) {
			return array_map([Str::class, 'camel'], array_keys($this->belongsTo));
		}

		return [];
	}

	/**
	 * @return array
	 */
	public function getBelongsToManyRelations()
	{
		if (isset($this->belongsToMany)) {
			return array_map([Str::class, 'camel'], array_keys($this->belongsToMany));
		}

		return [];
	}

	/**
	 * @return array
	 */
	public function getRelations()
	{
		return array_merge(
			$this->getBelongsToRelations(),
			$this->getBelongsToManyRelations()
		);
	}

	/**
	 * @param array $attributes
	 * @return $this
	 */
	public function updateRelations(array $attributes)
	{
		foreach ($attributes as $key => $value) {

			if (in_array($key, $this->getBelongsToRelations())) {
				$this->{$key}()->associate($value);
            }

			if (in_array($key, $this->getBelongsToManyRelations())) {
				$this->{$key}()->sync((array)$value);
			}

			continue;
		}

        $this->touch();
        $this->save();

		return $this;
	}
}
