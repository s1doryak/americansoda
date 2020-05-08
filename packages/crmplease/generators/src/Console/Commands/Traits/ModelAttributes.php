<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

trait ModelAttributes
{
	/**
	 * Get the default namespace for the class.
	 *
	 * @param string $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace;
	}

	/**
	 * Parse the class name and format according to the root namespace.
	 *
	 * @param string $name
	 * @return string
	 */
	protected function qualifyClass($name)
	{
		$rootNamespace = $this->rootNamespace();

		if (Str::startsWith($name, $rootNamespace)) {
			return $name;
		}

		$name = str_replace('/', '\\', $name);

		return $this->qualifyClass(
			$this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name
		);
	}

	/**
	 * Parse the class name and format according to the root namespace.
	 *
	 * @param string $name
	 * @return string
	 */
	protected function qualifyModelClass($name)
	{
		$modelNamespace = $this->modelNamespace();

		if (Str::startsWith($name, $modelNamespace)) {
			return $name;
		}

		$name = str_replace('/', '\\', $name);

		return $this->qualifyClass(
			trim($modelNamespace, '\\') . '\\' . $name
		);
	}

	/**
	 * @return string
	 */
	protected function getKeyName()
	{
		return 'id';
	}

	/**
	 * @param string $type
	 * @return string
	 */
	protected function getColumnType($type = 'string')
	{
		switch ($type) {
			case 'boolean':
			case 'checkbox':
				return 'boolean';
			case 'int':
			case 'integer':
			case 'number':
				return 'integer';
			case 'decimal':
				return 'decimal';
			case 'double':
				return 'double';
			case 'date':
			case 'datepicker':
				return 'date';
			case 'datetime':
				return 'dateTime';
			case 'float':
				return 'float';
			case 'text':
			case 'textarea':
				return 'text';
			case 'editor':
			case 'longtext':
			case 'long_text':
				return 'longText';
			case 'time':
				return 'time';
			case 'timepicker':
				return 'time';
			case 'timestamp':
				return 'timestamp';
			case 'color':
			case 'colorpicker':
				return 'string';
			case 'file':
			case 'image':
				return 'text';
			case 'blob':
			case 'binary':
				return 'binary';
			case 'json':
				return 'json';
			case 'array':
				return 'json';
			case 'password':
				return 'string';
			default:
				return 'string';
		}
	}


	/**
	 * @param string $type
	 * @return string
	 */
	protected function getFormType($type = 'string')
	{
		switch ($type) {
			case 'boolean':
			case 'checkbox':
				return 'checkbox';
			case 'int':
			case 'integer':
			case 'number':
				return 'number';
			case 'decimal':
			case 'double':
			case 'float':
				return 'text';
			case 'text':
			case 'textarea':
				return 'textarea';
			case 'editor':
			case 'longtext':
			case 'long_text':
				return 'editor';
			case 'date':
			case 'datetime':
			case 'datepicker':
			case 'time':
			case 'timestamp':
			case 'timepicker':
				return 'datepicker';
			case 'color':
			case 'colorpicker':
				return 'colorpicker';
			case 'file':
				return 'file';
			case 'image':
				return 'image';
			case 'blob':
			case 'binary':
				return 'textarea';
			case 'json':
				return 'textarea';
			case 'array':
				return 'textarea';
			case 'password':
				return 'password';
			default:
				return 'text';
		}
	}

	/**
	 * @param string $type
	 * @return string
	 */
	protected function isDate($type = 'string')
	{
		switch ($type) {
			case 'date':
			case 'datetime':
			case 'datepicker':
			case 'time':
			case 'timepicker':
			case 'timestamp':
				return true;
			default:
				return false;
		}
	}

	/**
	 * @param string $type
	 * @return string
	 */
	protected function isCast($type = 'string')
	{
		switch ($type) {
			case 'array':
			case 'boolean':
			case 'decimal':
			case 'float':
			case 'integer':
			case 'json':
				return true;
			default:
				return false;
		}
	}

	/**
	 * @param string $type
	 * @return string
	 */
	protected function getCastType($type = 'string')
	{
		switch ($type) {
			case 'boolean':
			case 'checkbox':
				return 'boolean';
			case 'int':
			case 'integer':
			case 'number':
				return 'integer';
			case 'decimal':
				return 'decimal:2';
			case 'double':
				return 'double';
			case 'float':
				return 'float';
			case 'date':
				return 'datetime:Y-m-d';
			case 'datetime':
				return 'datetime:Y-m-d H:i:s';
			case 'datepicker':
				return 'datetime:Y-m-d';
			case 'time':
				return 'datetime:H:i:s';
			case 'timepicker':
				return 'datetime:H:i:s';
			case 'timestamp':
				return 'datetime:Y-m-d H:i:s';
			case 'json':
				return 'object';
			case 'array':
				return 'array';
			default:
				return 'string';
		}
	}

	/**
	 * @param string $type
	 * @return string
	 */
	protected function getPropertyType($type = 'string')
	{
		switch ($type) {
			case 'boolean':
			case 'checkbox':
				return 'boolean';
			case 'int':
			case 'integer':
			case 'number':
				return 'integer';
			case 'decimal':
				return 'double';
			case 'double':
				return 'double';
			case 'float':
				return 'float';
			case 'date':
			case 'datetime':
			case 'datepicker':
			case 'time':
			case 'timestamp':
				return '\Illuminate\Support\Carbon|null';
			case 'image':
				return '\Crmplease\MaterialAdmin\Database\Eloquent\Traits\Image\ImageField';
			case 'file':
				return '\Crmplease\MaterialAdmin\Database\Eloquent\Traits\File\FileField';
			case 'json':
				return 'object';
			case 'array':
				return 'array';
			default:
				return 'string';
		}
	}

	/**
	 * @param $type
	 * @param $name
	 * @return string
	 */
	protected function getFakerString($type, $name)
	{
		switch ($name) {
			case 'email':
				return '$faker->unique()->safeEmail';
			case 'email_verified_at':
				return 'now()';
			case 'password':
				return 'bcrypt(\'secret\')';
			case 'name':
				return '$faker->unique()->name';
			case 'phone':
				return '$faker->unique()->phoneNumber';
			case 'color':
				return '$faker->safeHexColor';
			default:
				switch ($type) {
					case 'boolean':
						return '$faker->boolean';
					default:
						return 'null';
				}
		}
	}

	/**
	 * @return boolean
	 */
	protected function isAuthResource()
	{
		return (boolean)$this->option('auth');
	}

	/**
	 * @return boolean
	 */
	protected function isUuidResource()
	{
		return (boolean)$this->option('uuid');
	}

	/**
	 * @return boolean
	 */
	protected function hasFields()
	{
		return (boolean)$this->option('field');
	}

	/**
	 * @return boolean
	 */
	protected function hasBelongsTo()
	{
		return (boolean)$this->option('belongs-to');
	}

	/**
	 * @return boolean
	 */
	protected function hasMorphTo()
	{
		return (boolean)$this->option('morph-to');
	}

	/**
	 * @param string $column
	 * @param array $list
	 * @param boolean $in
	 * @return Collection
	 */
	protected function getFieldsFiltered($column, $list = [], $in = true)
	{
		return $this->getFields()->filter(function ($field) use ($column, $list, $in) {
			if ($in === true) {
				if (count($list)) {
					return in_array($field->{$column}, $list);
				} else {
					return $field->{$column};
				}
			} else {
				if (count($list)) {
					return !in_array($field->{$column}, $list);
				} else {
					return !$field->{$column};
				}
			}
		});
	}

	/**
	 * @return Collection
	 */
	protected function getFields()
	{
		$fields = new Collection();

		if ($this->isAuthResource()) {

			$authFields = [
				[
					'name' => 'email',
					'type' => 'string',
					'store_rules' => sprintf('sometimes|email|unique:%s', Str::plural(Str::snake($this->argument('name')))),
					'update_rules' => [
						"'required'",
						"'email'",
						sprintf("Rule::unique('%s')->ignore(\$%s->getKey())", Str::plural(Str::snake($this->argument('name'))), Str::snake($this->argument('name')))
					]
				],
				[
					'name' => 'email_verified_at',
					'type' => 'timestamp',
					'rules' => 'sometimes'
				],
				[
					'name' => 'password',
					'type' => 'password',
					'rules' => 'sometimes|string|min:6'
				]
			];

			foreach ($authFields as $field) {

				$name = $field['name'];
				$type = isset($field['type']) ? $field['type'] : 'string';
				$faker = $this->getFakerString($type, $name);

				$fields->push((object)[
					'name' => $name,
					'form_type' => $this->getFormType($type),
					'rules' => isset($field['rules']) ? $field['rules'] : null,
					'store_rules' => isset($field['store_rules']) ? $field['store_rules'] : null,
					'update_rules' => isset($field['update_rules']) ? $field['update_rules'] : null,
					'column_name' => $name,
					'column_type' => $this->getColumnType($type),
					'datatables_column' => $name,
					'faker' => $faker
				]);

			}
		}

		foreach ($this->option('field') as $relation) {
			$relationParams = explode(':', $relation);

			$name = Str::snake($relationParams[0]);
			$type = isset($relationParams[1]) ? Str::snake($relationParams[1]) : 'string';
			$faker = isset($relationParams[2]) ? trim($relationParams[2]) : $this->getFakerString($type, $name);

			if ($this->isAuthResource() && in_array($name, ['email', 'email_verified_at', 'password'])) {
				continue;
			}

			$fields->push((object)[
				'name' => $name,
				'form_type' => $this->getFormType($type),
				'rules' => 'sometimes',
				'column_name' => $name,
				'column_type' => $this->getColumnType($type),
				'datatables_column' => $name,
				'faker' => $faker
			]);

		}

		foreach ($this->option('morph-to') as $relation) {

			$relationParams = explode(':', $relation);

			$relation = isset($relationParams[0]) ? sprintf('%sable', Str::camel(Str::replaceLast('able', '', $relationParams[0]))) : sprintf('%sable', Str::camel(class_basename($model)));

			$name = sprintf('%s_type', $relation);
			$type = 'string';

			$fields->push((object)[
				'relation' => null,
				'relation_column' => null,
				'repository' => null,
				'model' => null,
				'name' => $name,
				'form_type' => $this->getFormType($type),
				'rules' => 'sometimes',
				'column_name' => $name,
				'column_type' => $this->getColumnType($type),
				'datatables_column' => null,
				'faker' => null,
			]);

			$name = sprintf('%s_id', $relation);
			$type = 'integer';

			$fields->push((object)[
				'relation' => null,
				'relation_column' => null,
				'repository' => null,
				'model' => null,
				'name' => $name,
				'form_type' => $this->getFormType($type),
				'rules' => 'sometimes',
				'column_name' => $name,
				'column_type' => $this->getColumnType($type),
				'datatables_column' => null,
				'faker' => null,
			]);

		}

		return $fields;
	}

	/**
	 * @return Collection
	 */
	protected function getBelongsTo()
	{
		$relations = new Collection();

		foreach ($this->option('belongs-to') as $relation) {
			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? Str::camel(Str::replaceLast('_id', '', $relationParams[1])) : Str::camel(class_basename($model));
			$relationColumn = isset($relationParams[2]) ? trim($relationParams[2]) : 'name';
			$table = Str::plural(Str::snake(class_basename($model)));
			$repository = Str::plural(Str::camel(class_basename($model)));

			$relations->push((object)[
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'repository' => $repository,
				'table' => $table,
				'model' => $model,
				'name' => $relation,
				'form_type' => 'choice',
				'rules' => sprintf('sometimes|exists:%s,id', $table),
				'column_name' => sprintf('%s_id', Str::snake($relation)),
				'column_type' => 'fk',
				'datatables_column' => sprintf('%s.%s', $relation, $relationColumn),
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpBelongsTo(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(
					"\t\t'%s' => [\\%s::class, '%s'],",
					$field->relation,
					$field->model,
					$field->column_name
				);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getBelongsToMany()
	{
		$relations = new Collection();

		foreach ($this->option('belongs-to-many') as $relation) {
			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? Str::plural(Str::camel(Str::replaceLast('_id', '', $relationParams[1]))) : Str::plural(Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[2]) ? trim($relationParams[2]) : 'name';
			$table = Str::plural(Str::snake(class_basename($model)));
			$repository = Str::plural(Str::camel(class_basename($model)));

			$relations->push((object)[
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'repository' => $repository,
				'table' => $table,
				'model' => $model,
				'name' => $relation,
				'form_type' => 'choice',
				'rules' => sprintf('sometimes|exists:%s,id', $table),
				'column_name' => null,
				'column_type' => null,
				'datatables_column' => sprintf('%s.%s', $relation, $relationColumn),
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpBelongsToMany(Collection $fields)
	{
		$class = Str::snake($this->getClassName());

		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) use ($class) {
				return sprintf(
					"\t\t'%s' => [\\%s::class, '%s_%s'],",
					$field->relation,
					$field->model,
					Str::snake(Str::singular($class)),
					Str::snake(Str::singular($field->relation))
				);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getBelongsToManyPivot()
	{
		$belongsToMany = $this->getBelongsToMany();

		$relations = new Collection();

		foreach ($this->option('belongs-to-many-pivot') as $relation) {
			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));

			$parent = $belongsToMany->first(function ($relation) use ($model) {
				return $relation->model === $model;
			});

			if (!$parent) {
				continue;
			}

			$relation = Str::plural($parent->relation);
			$table = Str::plural($parent->table);
			$repository = Str::plural(Str::camel(class_basename($model)));

			$name = Str::snake($relationParams[1]);
			$type = isset($relationParams[2]) ? Str::snake($relationParams[2]) : 'string';
			$faker = isset($relationParams[3]) ? trim($relationParams[3]) : $this->getFakerString($type, $name);

			$relations->push((object)[
				'relation' => $relation,
				'relation_column' => $name,
				'repository' => $repository,
				'table' => $table,
				'model' => $model,
				'name' => $name,
				'form_type' => $this->getFormType($type),
				'rules' => 'sometimes',
				'column_name' => $name,
				'column_type' => $this->getColumnType($type),
				'datatables_column' => sprintf('%s.%s', $relation, $name),
				'faker' => $faker
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpBelongsToManyPivot(Collection $fields)
	{
		$pivot = $fields->groupBy('relation');

		return $pivot
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function (Collection $fields, $relation) {
				return sprintf("\t\t'%s' => [%s],", $relation, $fields->map(function ($field) {
					return sprintf("'%s'", $field->name);
				})->implode(", "));
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getBelongsToManyPivotTimestamps()
	{
		$belongsToMany = $this->getBelongsToMany();

		$relations = new Collection();

		foreach ($this->option('belongs-to-many-pivot-timestamps') as $relation) {
			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));

			$parent = $belongsToMany->first(function ($relation) use ($model) {
				return $relation->model === $model;
			});

			if (!$parent) {
				continue;
			}

			$relation = $parent->relation;
			$table = $parent->table;

			$relations->push((object)[
				'relation' => Str::plural($relation),
				'table' => Str::plural($table),
				'model' => $model,
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpBelongsToManyPivotTimestamps(Collection $fields)
	{
		$pivot = $fields->groupBy('relation');

		return $pivot
			->map(function (Collection $fields, $relation) {
				return sprintf("\t\t'%s',", $relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getHasOne()
	{
		$relations = new Collection();

		foreach ($this->option('has-one') as $relation) {
			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? Str::singular(Str::camel(Str::replaceLast('_id', '', $relationParams[1]))) : Str::singular(Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[2]) ? trim($relationParams[2]) : 'name';
			$table = Str::plural(Str::snake(class_basename($model)));
			$repository = Str::plural(Str::camel(class_basename($model)));

			$relations->push((object)[
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'repository' => $repository,
				'model' => $model,
				'name' => $relation,
				'form_type' => 'choice',
				'rules' => sprintf('sometimes|exists:%s,id', $table),
				'column_name' => null,
				'column_type' => null,
				'datatables_column' => sprintf('%s.%s', $relation, $relationColumn),
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpHasOne(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => \\%s::class,", $field->relation, $field->model);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getHasMany()
	{
		$relations = new Collection();

		foreach ($this->option('has-many') as $relation) {
			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? Str::plural(Str::camel(Str::replaceLast('_id', '', $relationParams[1]))) : Str::plural(Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[2]) ? trim($relationParams[2]) : 'name';
			$table = Str::plural(Str::snake(class_basename($model)));
			$repository = Str::plural(Str::camel(class_basename($model)));

			$relations->push((object)[
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'repository' => $repository,
				'model' => $model,
				'name' => $relation,
				'form_type' => 'choice',
				'rules' => sprintf('sometimes|exists:%s,id', $table),
				'column_name' => null,
				'column_type' => null,
				'datatables_column' => sprintf('%s.%s', $relation, $relationColumn),
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpHasMany(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => \\%s::class,", $field->relation, $field->model);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * ToDo: needs reimplementation
	 * @return Collection
	 */
	protected function getHasManyThrough()
	{
		$relations = new Collection();

		foreach ($this->option('has-many-through') as $relation) {
			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? Str::plural(Str::camel(Str::replaceLast('_id', '', $relationParams[1]))) : Str::plural(Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[2]) ? trim($relationParams[2]) : 'name';
			$table = Str::plural(Str::snake(class_basename($model)));
			$repository = Str::plural(Str::camel(class_basename($model)));

			$relations->push((object)[
				'relation' => Str::plural($relation),
				'relation_column' => $relationColumn,
				'repository' => $repository,
				'model' => $model,
				'name' => Str::plural($relation),
				'form_type' => 'choice',
				'rules' => sprintf('sometimes|exists:%s,id', $table),
				'column_name' => null,
				'column_type' => null,
				'datatables_column' => sprintf('%s.%s', $relation, $relationColumn),
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpHasManyThrough(Collection $fields)
	{
		if ($fields->count()) {
			return '\t\t// Method "dumpHasManyThrough" not implemented yet.';
		}

		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => \\%s::class,", $field->relation, $field->model);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getMorphTo()
	{
		$model = $this->qualifyModelClass(Str::studly($this->argument('name')));

		$relations = new Collection();

		foreach ($this->option('morph-to') as $relation) {

			$relationParams = explode(':', $relation);
			$relationModels = array_slice($relationParams, 2);

			$relation = isset($relationParams[0]) ? sprintf('%sable', Str::camel(Str::replaceLast('able', '', $relationParams[0]))) : sprintf('%sable', Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[1]) ? trim($relationParams[1]) : 'name';
			$model = count($relationModels) ? collect($relationModels)->map(function ($model) {
				return $this->qualifyModelClass(
					Str::studly($model)
				);
			})->toArray() : null;

			$relations->push((object)[
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'model' => $model,
				'name' => $relation,
				'form_type' => null,
				'rules' => null,
				'column_name' => null, // Str::snake($relation),
				'column_type' => null, // 'morphs',
				'datatables_column' => sprintf('%s.%s', $relation, $relationColumn),
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMorphTo(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s',", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * Parse --morph-one generator option.
	 *
	 * Format:
	 * --morph-one=RESOURCE[:RELATION][:FOREIGN][:FIELD]
	 * Example:
	 * --morph-one=AccountingReport:accountingReport:accountable:id
	 * or
	 * --morph-one=Like:like:likeable:name
	 * is equal to:
	 * --morph-one=Like
	 *
	 * @return Collection
	 */
	protected function getMorphOne()
	{
		$relations = new Collection();

		foreach ($this->option('morph-one') as $relation) {

			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? $relationParams[1] : Str::singular(Str::camel(class_basename($model)));
			$relationForeign = isset($relationParams[2]) ? $relationParams[2] : sprintf('%sable', Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[3]) ? trim($relationParams[3]) : 'name';
			$table = Str::plural(Str::snake(class_basename($model)));
			$repository = Str::plural(Str::camel(class_basename($model)));

			$relations->push((object)[
				'model' => $model,
				'name' => $relation,
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'relation_foreign' => $relationForeign,
				'repository' => $repository,
				'form_type' => 'choice',
				'rules' => sprintf('sometimes|exists:%s,id', $table),
				'column_name' => null,
				'column_type' => null,
				'datatables_column' => sprintf('%s.%s', $relation, $relationColumn),
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMorphOne(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => [\\%s::class, '%s'],", $field->relation, $field->model, $field->relation_foreign);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * Parse --morph-many generator option.
	 *
	 * Format:
	 * --morph-many=RESOURCE[:RELATION][:FOREIGN][:FIELD]
	 * Example:
	 * --morph-many=AccountingReport:accountingReports:accountable:id
	 * or
	 * --morph-many=Like:likes:likeable:name
	 * is equal to:
	 * --morph-many=Like
	 *
	 * @return Collection
	 */
	protected function getMorphMany()
	{
		$relations = new Collection();

		foreach ($this->option('morph-many') as $relation) {

			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? $relationParams[1] : Str::plural(Str::camel(class_basename($model)));
			$relationForeign = isset($relationParams[2]) ? $relationParams[2] : sprintf('%sable', Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[3]) ? trim($relationParams[3]) : 'name';
			$table = Str::plural(Str::snake(class_basename($model)));
			$repository = Str::plural(Str::camel(class_basename($model)));

			$relations->push((object)[
				'model' => $model,
				'name' => $relation,
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'relation_foreign' => $relationForeign,
				'repository' => $repository,
				'form_type' => 'choice',
				'rules' => sprintf('sometimes|exists:%s,id', $table),
				'column_name' => null,
				'column_type' => null,
				'datatables_column' => sprintf('%s.%s', $relation, $relationColumn),
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMorphMany(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => [\\%s::class, '%s'],", $field->relation, $field->model, $field->relation_foreign);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getMorphToMany()
	{
		$relations = new Collection();

		foreach ($this->option('morph-to-many') as $relation) {

			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? $relationParams[1] : Str::plural(Str::camel(class_basename($model)));
			$name = isset($relationParams[2]) ? $relationParams[2] : sprintf('%sable', Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[3]) ? trim($relationParams[3]) : 'name';

			$relations->push((object)[
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'model' => $model,
				'name' => $name,
				'form_type' => null,
				'rules' => null,
				'column_name' => null,
				'column_type' => null,
				'datatables_column' => null,
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMorphToMany(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => [\\%s::class, '%s'],", $field->relation, $field->model, $field->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getMorphedByMany()
	{
		$relations = new Collection();

		foreach ($this->option('morphed-by-many') as $relation) {

			$relationParams = explode(':', $relation);

			$model = $this->qualifyModelClass(Str::studly($relationParams[0]));
			$relation = isset($relationParams[1]) ? $relationParams[1] : Str::plural(Str::camel(class_basename($model)));
			$name = isset($relationParams[2]) ? $relationParams[2] : sprintf('%sable', Str::camel(class_basename($model)));
			$relationColumn = isset($relationParams[3]) ? trim($relationParams[3]) : 'name';

			$relations->push((object)[
				'relation' => $relation,
				'relation_column' => $relationColumn,
				'model' => $model,
				'name' => $name,
				'form_type' => null,
				'rules' => null,
				'column_name' => null,
				'column_type' => null,
				'datatables_column' => null,
			]);

		}

		return $relations;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMorphedByMany(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => [\\%s::class, '%s'],", $field->relation, $field->model, $field->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getBelongsToRelations()
	{
		return collect()
			->concat($this->getBelongsTo())
			->concat($this->getBelongsToMany());
	}

	/**
	 * @return Collection
	 */
	protected function getHasRelations()
	{
		return collect()
			->concat($this->getHasOne())
			->concat($this->getHasMany())
			->concat($this->getHasManyThrough());
	}

	/**
	 * @return Collection
	 */
	protected function getMorphToRelations()
	{
		return collect()
			->concat($this->getMorphTo());
	}

	/**
	 * @return Collection
	 */
	protected function getMorphRelations()
	{
		return collect()
			->concat($this->getMorphOne())
			->concat($this->getMorphMany())
			->concat($this->getMorphToMany())
			->concat($this->getMorphedByMany());
	}

	/**
	 * @return Collection
	 */
	protected function getRelations()
	{
		return collect()
			->concat($this->getBelongsToRelations())
			->concat($this->getMorphToRelations());
	}

	/**
	 * @return Collection
	 */
	protected function getInverseRelations()
	{
		return collect()
			->concat($this->getHasRelations())
			->concat($this->getMorphRelations());
	}

	/**
	 * @return Collection
	 */
	protected function getTraits()
	{
		/** @var Collection $traits */
		$traits = new Collection();

		if ($this->isAuthResource()) {
			$traits->push('Illuminate\Auth\MustVerifyEmail');
		}

		if ($this->isUuidResource()) {
			$traits->push('Crmplease\MaterialAdmin\Database\Eloquent\Traits\UuidModel');
		}

		return $traits;
	}

	/**
	 * @param Collection $traits
	 * @return string
	 */
	protected function dumpTraits(Collection $traits)
	{
		return $traits
			->filter()
			->map(function ($trait) {
				return sprintf("use %s;", $trait);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $traits
	 * @return string
	 */
	protected function dumpUse(Collection $traits)
	{
		if ($traits->isNotEmpty()) {

			$use = $traits
				->filter()
				->map(function ($trait) {
					return class_basename($trait);
				})
				->unique()
				->implode(", ");

			return sprintf("\tuse %s;", $use);
		}

		return "";
	}

	/**
	 * @return Collection
	 */
	protected function getExtra()
	{
		/** @var Collection $properties */
		$properties = new Collection();

		if ($this->isUuidResource()) {
			$properties->push(
				implode(
					"\n",
					[
						sprintf("\t"),
						sprintf("\t/**"),
						sprintf("\t * @var boolean"),
						sprintf("\t */"),
						sprintf("\tpublic \$incrementing = false;"),
					]
				)
			);
		}

		return $properties;
	}

	/**
	 * @return Collection
	 */
	protected function getTimestamps()
	{
		$properties = [
			(object)['name' => 'created_at',],
			(object)['name' => 'updated_at',],
			(object)['name' => 'deleted_at',]
		];

		return collect($properties);
	}

	/**
	 * @param Collection $properties
	 *
	 * @return string
	 */
	protected function dumpExtra(Collection $properties)
	{
		return $properties
			->filter()
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getRepositories()
	{
		$name = Str::replaceFirst($this->rootNamespace(), '', $this->argument('name'));

		$modelNamespace = $this->modelNamespace();

		return $this->getRelations()
			->filter(function ($relation) {
				return $relation->repository ?? false;
			})
			->pluck('model')
			->map(function ($class) use ($modelNamespace) {
				return Str::replaceFirst($modelNamespace, '', $class);
			})
			->prepend($name)
			->unique()
			->map(function ($class) {
				return sprintf('%sRepository', $class);
			});
	}

	/**
	 * @param Collection $repositories
	 *
	 * @return string
	 */
	protected function dumpRepositories(Collection $repositories)
	{
		return $repositories
			->filter()
			->map(function ($repository) {
				return sprintf('use App\\Repositories\\Contracts\\%s;', $repository);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $repositories
	 *
	 * @return string
	 */
	protected function dumpConstructorPhpDoc(Collection $repositories)
	{
		return $repositories
			->filter()
			->map(function ($repository) {
				return sprintf("\t * @param %s $%s", $repository, Str::camel($repository));
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $repositories
	 *
	 * @return string
	 */
	protected function dumpConstructorSignature(Collection $repositories)
	{
		$signature = $repositories
			->filter()
			->map(function ($repository) {
				return sprintf("\t\t%s $%s,", $repository, Str::camel($repository));
			})
			->unique()
			->implode("\n");

		return Str::replaceLast(',', '', $signature);
	}

	/**
	 * @return Collection
	 */
	protected function getProperties()
	{
		$modelNamespace = $this->modelNamespace();

		return $this->getRelations()
			->filter(function ($relation) {
				return $relation->repository ?? false;
			})
			->mapWithKeys(function ($relation) use ($modelNamespace) {
				$repository = sprintf('%sRepository', Str::replaceFirst($modelNamespace, '', $relation->model));
				return [$relation->repository => $repository];
			});
	}

	/**
	 * @param Collection $properties
	 *
	 * @return string
	 */
	protected function dumpProperties(Collection $properties)
	{
		return $properties
			->filter()
			->map(function ($repository, $property) {
				return implode(
					"\n",
					[
						sprintf("\t"),
						sprintf("\t/**"),
						sprintf("\t * @var %s", $repository),
						sprintf("\t */"),
						sprintf("\tprotected $%s;", $property),
					]
				);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getFormConfigData()
	{
		return $this->getBelongsToRelations();
	}

	/**
	 * @param Collection $relations
	 *
	 * @return string
	 */
	protected function dumpFormConfigData(Collection $relations)
	{
		return $relations
			->filter(function ($relation) {
				return $relation->relation ?? false;
			})
			->map(function ($relation) {
				if (Str::plural($relation->relation) === $relation->repository) {
					return sprintf("\t\t'%s' => '%s',", Str::plural($relation->relation), $relation->relation_column);
				} else {
					return implode(
						"\n",
						[
							sprintf("\t\t'%s' => [", Str::plural($relation->relation)),
							sprintf("\t\t\t'repository' => '%s',", $relation->repository),
							sprintf("\t\t\t'lists' => '%s',", $relation->relation_column),
							sprintf("\t\t],"),
						]
					);
				}
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getFindOrCreateData()
	{
		return $this->getBelongsToRelations();
	}

	/**
	 * @param Collection $relations
	 * @return string
	 */
	protected function dumpFindOrCreateData(Collection $relations)
	{
		return $relations
			->filter(function ($relation) {
				return $relation->relation ?? false;
			})
			->map(function ($relation) {
				if (Str::plural($relation->relation) === $relation->repository) {
					return sprintf("\t\t'%s' => '%s',", Str::plural($relation->relation), $relation->relation_column);
				} else {
					return implode(
						"\n",
						[
							sprintf("\t\t'%s' => [", Str::plural($relation->relation)),
							sprintf("\t\t\t'repository' => '%s',", $relation->repository),
							sprintf("\t\t\t'lists' => '%s',", $relation->relation_column),
							sprintf("\t\t],"),
						]
					);
				}
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $properties
	 * @param boolean $prepend
	 * @return string
	 */
	protected function dumpConstructorBody(Collection $properties, $prepend = true)
	{
		$mapped = $properties->map(
			function ($repository, $property) {
				return sprintf("\t\t\$this->%s = \$%s;", $property, Str::camel($repository));
			}
		);

		if ($prepend) {
			$name = Str::replaceFirst($this->rootNamespace(), '', $this->argument('name'));

			$mapped->prepend(sprintf("\t\t\$this->repository = \$%sRepository;", Str::camel($name)));
		}

		return $mapped
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getCasts()
	{
		return $this->getFields()
			->filter(function ($field) {
				return $this->isCast($field->column_type);
			});
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpCasts(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->column_type ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => '%s',", $field->name, $this->getCastType($field->column_type));
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getDates()
	{
		return $this->getFields()
			->filter(function ($field) {
				return $this->isDate($field->column_type);
			});
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpDates(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s',", $field->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getImages()
	{
		return $this->getFields()
			->filter(function ($field) {
				return $field->form_type == 'image';
			});
	}

	/**
	 * @return boolean
	 */
	protected function hasImages()
	{
		return $this->getImages()->isNotEmpty();
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpImages(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s',", $field->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getFiles()
	{
		return $this->getFields()
			->filter(function ($field) {
				return $field->form_type == 'file';
			});
	}

	/**
	 * @return boolean
	 */
	protected function hasFiles()
	{
		return $this->getFiles()->isNotEmpty();
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpFiles(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s',", $field->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getFillable()
	{
		return collect()
			->concat($this->getFields())
			->concat($this->getBelongsTo())
			->concat($this->getMorphTo());
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpFillable(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->column_name;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s',", $field->column_name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param array $sections
	 * @return string
	 */
	protected function dumpPhpDoc($sections)
	{
		return collect($sections)
			->filter(function ($section) {
				return trim($section);
			})
			->prepend(" *")
			->implode("\n");
	}

	/**
	 * @param string $id
	 * @return string
	 */
	protected function dumpPhpDocId($id)
	{
		if ($this->isUuidResource()) {
			return sprintf(" * @property string \$%s", $id);
		}

		return sprintf(" * @property integer \$%s", $id);
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property %s \$%s", $this->getPropertyType($field->column_type), $field->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocTimestamps(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\Illuminate\\Support\\Carbon|null \$%s", $field->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocBelongsToProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\%s|null \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocBelongsToManyProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\Illuminate\\Support\\Collection|\\%s[] \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocHasOneProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\%s|null \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocHasManyProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\Illuminate\\Support\\Collection|\\%s[] \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocHasManyThroughProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\Illuminate\\Support\\Collection|\\%s[] \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphToProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				$model = $field->model;

				if (is_array($model)) {

					$models = collect($model)->map(function ($model) {
						return sprintf("\\%s", $model);
					})->implode("|");

					return sprintf(" * @property %s|null \$%s", $models, $field->relation);
				}

				return sprintf(" * @property \\%s|null \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphOneProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\%s|null \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphManyProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\Illuminate\\Support\\Collection|\\%s[] \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphToManyProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\Illuminate\\Support\\Collection|\\%s[] \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphedByManyProperties(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @property \\Illuminate\\Support\\Collection|\\%s[] \$%s", $field->model, $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocBelongsToMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\BelongsTo %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocBelongsToManyMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocHasOneMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\HasOne %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocHasManyMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\HasMany %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocHasManyThroughMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\HasManyThrough %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphToMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\MorphTo %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphOneMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\MorphOne %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphManyMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\MorphMany %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphToManyMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\MorphToMany %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpPhpDocMorphedByManyMethods(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->relation ?? false;
			})
			->map(function ($field) {
				return sprintf(" * @method \\Illuminate\\Database\\Eloquent\\Relations\\MorphedByMany %s()", $field->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getDatatablesColumns()
	{
		return collect()
			->concat($this->getFieldsFiltered('name', self::PROTECTED, false))
			->concat($this->getBelongsToRelations())
			->concat($this->getMorphToRelations());
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpDatatablesColumns(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->datatables_column ?? false;
			})
			->map(function ($field) {
				if (isset($field->relation)) {
					return sprintf(implode("\n", [
						"\t\t\t'%s' => [",
						"\t\t\t\t'data' => '%s'",
						"\t\t\t],",
					]), $field->datatables_column, $field->datatables_column);
				} else {
					return sprintf("\t\t\t'%s',", $field->datatables_column);
				}
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getDatatablesRawColumns()
	{
		$action = (object)[
			'name' => 'action',
			'data' => 'action',
			'datatables_column' => 'action'
		];

		return $this->getDatatablesColumns()->push($action);
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpDatatablesRawColumns(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->datatables_column ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t\t'%s',", $field->datatables_column);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getDatatablesAggregateColumns()
	{
		return $this->getFields()
			->filter(function ($field) {
				switch ($field->column_type) {
					case 'int':
					case 'integer':
					case 'number':
					case 'decimal':
					case 'double':
					case 'float':
						return true;
					default:
						return false;
				}
			});
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpDatatablesAggregateColumns(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->datatables_column ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t\t'%s',", $field->datatables_column);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getDatatablesFilterableColumns()
	{
		return collect()
			->concat($this->getBelongsToRelations())
			->concat($this->getMorphToRelations());
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpDatatablesFilterableColumns(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->datatables_column ?? false;
			})
			->map(function ($field) {
				if (isset($field->relation)) {
					return sprintf(implode("\n", [
						"\t\t\t'%s' => [",
						"\t\t\t\t'type' => 'choice',",
						"\t\t\t\t'multiple' => true,",
						"\t\t\t\t'operator' => 'in',",
						"\t\t\t\t'data' => '%s.id',",
						"\t\t\t\t'lists' => '%s',",
						"\t\t\t],",
					]), $field->datatables_column, $field->relation, $field->datatables_column);
				} else {
					return sprintf("\t\t\t'%s',", $field->datatables_column);
				}
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getDefaultHidden()
	{
		return collect([
			(object)['name' => 'password'],
			(object)['name' => 'remember_token']
		]);
	}

	/**
	 * @return Collection
	 */
	protected function getHidden()
	{
		$fields = collect();

		if ($this->isAuthResource()) {
			$fields->concat($this->getDefaultHidden());
		}

		return $fields;
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpHidden(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s',", $field->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getFactoryFields()
	{
		return $this->getFields();
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpFactoryFields(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->faker ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t'%s' => %s,", $field->name, $field->faker);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getFormFields()
	{
		return collect()
			->concat($this->getFieldsFiltered('name', self::PROTECTED, false))
			->concat($this->getBelongsToRelations())
			->concat($this->getMorphToRelations());
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpFormFields(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->form_type ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t\t'%s' => '%s',", $field->name, $field->form_type);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpValidationRules(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->rules ?? false;
			})
			->map(function ($field) {
				$rules = $field->rules;

				if (is_array($rules)) {
					return sprintf("\t\t\t'%s' => [\n%s\n\t\t\t],", $field->name, collect($rules)->map(function ($rule) {
						return sprintf("\t\t\t\t%s,", $rule);
					})->implode("\n"));
				}

				return sprintf("\t\t\t'%s' => '%s',", $field->name, $rules);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpStoreValidationRules(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->store_rules ?? $field->rules ?? false;
			})
			->map(function ($field) {
				$rules = isset($field->store_rules) ? $field->store_rules : $field->rules;

				if (is_array($rules)) {
					return sprintf("\t\t\t'%s' => [\n%s\n\t\t\t],", $field->name, collect($rules)->map(function ($rule) {
						return sprintf("\t\t\t\t%s,", $rule);
					})->implode("\n"));
				}

				return sprintf("\t\t\t'%s' => '%s',", $field->name, $rules);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpUpdateValidationRules(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->update_rules ?? $field->rules ?? false;
			})
			->map(function ($field) {
				$rules = isset($field->update_rules) ? $field->update_rules : $field->rules;

				if (is_array($rules)) {
					return sprintf("\t\t\t'%s' => [\n%s\n\t\t\t],", $field->name, collect($rules)->map(function ($rule) {
						return sprintf("\t\t\t\t%s,", $rule);
					})->implode("\n"));
				}

				return sprintf("\t\t\t'%s' => '%s',", $field->name, $rules);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getTransformerFields()
	{
		return $this->getFieldsFiltered('name', self::PROTECTED, false);
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpTransformerRequestFields(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($field) {

				switch ($field->form_type) {
					case 'image':
					case 'file':
						return sprintf("\t\t\t'%s' => \$request->file('%s'),", $field->name, $field->name);
						break;
					case 'boolean':
					case 'checkbox':
						return sprintf("\t\t\t'%s' => (boolean)\$request->get('%s'),", $field->name, $field->name);
					case 'int':
					case 'integer':
					case 'number':
						return sprintf("\t\t\t'%s' => (integer)\$request->get('%s'),", $field->name, $field->name);
					case 'decimal':
					case 'double':
						return sprintf("\t\t\t'%s' => (double)\$request->get('%s'),", $field->name, $field->name);
					case 'float':
						return sprintf("\t\t\t'%s' => (float)\$request->get('%s'),", $field->name, $field->name);
						break;
					default:
						return sprintf("\t\t\t'%s' => \$request->get('%s'),", $field->name, $field->name);
						break;
				}
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $relations
	 * @return string
	 */
	protected function dumpTransformerRequestRelations(Collection $relations)
	{
		return $relations
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($relation) {
				return sprintf("\t\t\t'%s' => (integer)\$request->get('%s'),", $relation->name, $relation->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $relations
	 * @return string
	 */
	protected function dumpTransformerRequestManyRelations(Collection $relations)
	{
		return $relations
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($relation) {
				return sprintf("\t\t\t'%s' => (array)\$request->get('%s'),", $relation->name, $relation->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpTransformerToArrayFields(Collection $fields)
	{
		$class = $this->getClassName();

		return $fields
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($field) use ($class) {

				switch ($field->form_type) {
					case 'image':
					case 'file':
						return sprintf("\t\t\t'%s' => (string)\$%s->%s ? asset((string)\$%s->%s) : null,", $field->name, Str::camel($class), $field->name, Str::camel($class), $field->name);
						break;
					case 'boolean':
					case 'checkbox':
						return sprintf("\t\t\t'%s' => (boolean)\$%s->%s,", $field->name, Str::camel($class), $field->name);
					case 'int':
					case 'integer':
					case 'number':
						return sprintf("\t\t\t'%s' => (integer)\$%s->%s,", $field->name, Str::camel($class), $field->name);
					case 'decimal':
					case 'double':
						return sprintf("\t\t\t'%s' => (double)\$%s->%s,", $field->name, Str::camel($class), $field->name);
					case 'float':
						return sprintf("\t\t\t'%s' => (float)\$%s->%s,", $field->name, Str::camel($class), $field->name);
						break;
					default:
						return sprintf("\t\t\t'%s' => \$%s->%s,", $field->name, Str::camel($class), $field->name);
						break;
				}
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $relations
	 * @return string
	 */
	protected function dumpTransformerToArrayRelations(Collection $relations)
	{
		$class = $this->getClassName();

		return $relations
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($relation) use ($class) {
				return sprintf("\t\t\t'%s' => \$%s->%s ? %sTransformer::toArray(\$%s->%s) : null,", $relation->name, Str::camel($class), $relation->name, class_basename($relation->model), Str::camel($class), $relation->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $relations
	 * @return string
	 */
	protected function dumpTransformerToArrayManyRelations(Collection $relations)
	{
		$class = $this->getClassName();

		return $relations
			->filter(function ($field) {
				return $field->name ?? false;
			})
			->map(function ($relation) use ($class) {
				return sprintf("\t\t\t'%s' => \$%s->%s ? %sTransformer::map(\$%s->%s) : [],", $relation->name, Str::camel($class), $relation->name, class_basename($relation->model), Str::camel($class), $relation->name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getWith()
	{
		return collect()
			->concat($this->getBelongsToRelations())
			->concat($this->getMorphToRelations());
	}

	/**
	 * @param Collection $relations
	 * @return string
	 */
	protected function dumpWith(Collection $relations)
	{
		return $relations
			->filter(function ($relation) {
				return $relation->relation ?? false;
			})
			->map(function ($relation) {
				return sprintf("\t\t'%s',", $relation->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getTouches()
	{
		return collect()
			->concat($this->getBelongsToRelations())
			->concat($this->getMorphToRelations());
	}

	/**
	 * @param Collection $relations
	 * @return string
	 */
	protected function dumpTouches(Collection $relations)
	{
		return $relations
			->filter(function ($relation) {
				return $relation->relation ?? false;
			})
			->map(function ($relation) {
				return sprintf("\t\t'%s',", $relation->relation);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getMigrationFields()
	{
		return $this->getFields()
			->filter(function ($field) {
				return $field->column_type ?? false;
			})
			->mapWithKeys(function ($field) {
				return [$field->column_name => $field->column_type];
			});
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMigrationFields(Collection $fields)
	{
		$strings = $fields->map(function ($type, $field) {
			switch ($field) {
				case 'email':
					if ($this->isAuthResource()) {
						return sprintf("\t\t\t\$table->%s('%s')->unique();", $type, $field);
					} else {
						return sprintf("\t\t\t\$table->%s('%s')->nullable();", $type, $field);
					}
					break;
				default:
					return sprintf("\t\t\t\$table->%s('%s')->nullable();", $type, $field);
					break;
			}
		});

		if ($this->isAuthResource()) {
			$strings->push("\t\t\t\$table->rememberToken();");
		}

		return $strings
			->unique()
			->implode("\n");
	}

	/**
	 * @return Collection
	 * @todo refactor
	 */
	protected function getMigrationFks()
	{
		return $this->getBelongsTo()->mapWithKeys(function ($field) {
			return [$field->column_name => $field->table];
		});
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMigrationFks(Collection $fields)
	{
		return $fields
			->map(function ($table, $field) {
				return implode("\n", [
					sprintf("\t\t\t\$table->fk(["),
					sprintf("\t\t\t\t'column' => '%s',", $field),
					sprintf("\t\t\t\t'table' => '%s',", $table),
					sprintf("\t\t\t], 'cascade', true);"),
				]);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMigrationMorphTo(Collection $fields)
	{
		return $fields
			->filter(function ($field) {
				return $field->column_name ?? false;
			})
			->map(function ($field) {
				return sprintf("\t\t\t\$table->%s('%s');", $field->column_type, $field->column_name);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMigrationPivotFields(Collection $fields)
	{
		$table = Str::plural(Str::snake($this->argument('b')));

		$pivot = $fields->filter(function ($field) use ($table) {
			return $field->table === $table;
		});

		return $pivot
			->filter(function ($field) {
				return $field->column_name ?? false;
			})
			->mapWithKeys(function ($field) {
				return [$field->column_name => $field->column_type];
			})->map(function ($type, $field) {
				return sprintf("\t\t\t\$table->%s('%s')->nullable();", $type, $field);
			})
			->unique()
			->implode("\n");
	}

	/**
	 * @param Collection $fields
	 * @return string
	 */
	protected function dumpMigrationPivotTimestamps(Collection $fields)
	{
		$table = Str::plural(Str::snake($this->argument('b')));

		$pivot = $fields->filter(function ($field) use ($table) {
			return $field->table === $table;
		});

		return $pivot
			->map(function ($field) {
				return sprintf("\t\t\t\$table->timestamps();");
			})
			->unique()
			->implode("\n");
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getModelOptions()
	{
		return [
			['auth', null, InputOption::VALUE_NONE, 'Authenticatable model.'],

			['uuid', null, InputOption::VALUE_NONE, 'UUID model.'],

			['field', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model fields.'],

			['belongs-to', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model One-to-Many (Inverse) relations.'],

			['belongs-to-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model Many-to-Many relations.'],

			['belongs-to-many-pivot', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model Many-to-Many relations pivot fields.'],

			['belongs-to-many-pivot-timestamps', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model Many-to-Many relations pivot timestamps fields.'],

			['has-one', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model One-to-One relations.'],

			['has-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model Many-to-One relations.'],

			['has-many-through', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model Many-to-One relations.'],

			['morph-to', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Model Polymorphic parent relation.'],

			['morph-one', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model One To One Polymorphic relations.'],

			['morph-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model One To Many Polymorphic relations.'],

			['morph-to-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model Many-to-Many Polymorphic relations.'],

			['morphed-by-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Model Inverse Of Many-to-Many Polymorphic relations.'],
		];
	}
}
