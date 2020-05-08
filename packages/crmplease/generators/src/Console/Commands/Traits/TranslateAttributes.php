<?php

namespace Crmplease\Generators\Console\Commands\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Trait TranslateAttributes
 *
 * @package Crmplease\Generators\Console\Commands\Traits
 */
trait TranslateAttributes
{
	/**
	 * @return Collection
	 */
	protected function getDefaultTranslateFields()
	{
		return collect($this->defaultLabels);
	}

	/**
	 * @param string $field
	 * @return string
	 */
	protected function getDefaultTranslationLabel($field)
	{
		$parts = explode('.', $field);

		$fieldName = array_pop($parts);

		if (in_array($fieldName, ['id', 'name'])) {
			$fieldName = array_shift($parts);
		}

		$canonical = Str::snake(Str::replaceLast('_id', '', $fieldName));

		return implode(' ', array_map(function ($label) {
			return Str::ucfirst($label);
		}, explode('_', $canonical)));
	}

	/**
	 * @param string $field
	 * @param string $locale
	 * @param string $modifier
	 * @return string
	 */
	protected function getTranslationFieldLabel($field, $locale, $modifier = '')
	{
		$fields = $this->getTranslateFields()
			->merge(
				$this->getDefaultTranslateFields()
			)
			->toArray();

		if (isset($fields[$field][$locale][$modifier])) {
			return Str::ucfirst($fields[$field][$locale][$modifier]);
		}

		if (isset($fields[$field][$locale])) {
			return Str::ucfirst($fields[$field][$locale]);
		}

		return $this->getDefaultTranslationLabel($field);
	}

	/**
	 * @param string $field
	 * @param string $locale
	 * @param string $modifier
	 * @param integer $case
	 * @return string
	 */
	protected function getTranslationRelationLabel($field, $locale, $modifier = '', $case = 0)
	{
		$fields = $this->getTranslateRelations()->toArray();

		if (isset($fields[$field][$locale])) {

			if (isset($fields[$field][$locale][$case])) {
				return Str::ucfirst($fields[$field][$locale][$case]);
			}

			return Str::ucfirst($fields[$field][$locale]);
		}

		return $this->getDefaultTranslationLabel($field);
	}

	/**
	 * @return Collection
	 */
	protected function getTranslationFields()
	{
		return $this->getFields()->pluck('name');
	}

	/**
	 * @param Collection $fields
	 * @param string $locale
	 * @param string $modifier
	 * @return string
	 */
	protected function dumpTranslationFields(Collection $fields, $locale, $modifier = '')
	{
		return $fields->map(function ($field) use ($locale, $modifier) {
			return sprintf(
				"\t\t'%s' => '%s',",
				$field,
				$this->getTranslationFieldLabel($field, $locale, $modifier)
			);
		})->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getTranslationRelations()
	{
		return collect()
			->concat($this->getRelations())
			//->concat($this->getInverseRelations())
			->pluck('name');
	}

	/**
	 * @param Collection $fields
	 * @param string $locale
	 * @param string $modifier
	 * @param integer $case
	 * @return string
	 */
	protected function dumpTranslationRelations(Collection $fields, $locale, $modifier = '', $case = 0)
	{
		$relationFields = $this->getTranslateRelations();

		return $fields->map(function ($field) use ($locale, $modifier, $case, $relationFields) {

			$filtered = $relationFields->filter(function ($translation, $relationField) use ($field) {
				return Str::startsWith($relationField, "{$field}.");
			});

			$lines = $filtered->map(function ($translation, $relationField) use ($field, $locale, $modifier, $case) {
				$relationColumn = str_replace("{$field}.", '', $relationField);
				return sprintf(
					"\t\t\t'%s' => '%s',",
					$relationColumn,
					$this->getTranslationRelationLabel($relationField, $locale, $modifier, $case)
				);
			});

			return sprintf(
				"\t\t'%s' => [\n%s\n\t\t],",
				$field,
				$lines->implode("\n")
			);

		})->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getTranslationPlaceholders()
	{
		return collect()
			->concat($this->getRelations())
			//->concat($this->getInverseRelations())
			->pluck('name');
	}

	/**
	 * @param Collection $fields
	 * @param string $locale
	 * @param string $modifier
	 * @param integer $case
	 * @return string
	 */
	protected function dumpTranslationPlaceholders(Collection $fields, $locale, $modifier = '', $case = 0)
	{
		$relationFields = $this->getTranslateRelations();

		return $fields->map(function ($field) use ($locale, $modifier, $case, $relationFields) {

			$filtered = $relationFields->filter(function ($translation, $relationField) use ($field) {
				return Str::startsWith($relationField, "{$field}.");
			});

			$relationColumn = sprintf("%s.name", $field);

			if ($filtered->count()) {
				$relationColumn = $filtered->keys()->first();
			}

			$placeholder = trans('generators::generator.translation.placeholders.select', [
				'relation' => $this->getTranslationRelationLabel($relationColumn, $locale, $modifier, $case)
			], $locale);

			return sprintf("\t\t'%s' => '%s',", $field, $placeholder);
		})->implode("\n");
	}

	/**
	 * @return Collection
	 */
	protected function getTranslate()
	{
		$fallback = config('app.fallback_locale');

		$translate = collect(
			$this->option('translate')
		)->mapWithKeys(function ($string) {
			$parts = explode(':', $string);

			$locale = Str::slug((string)array_shift($parts));

			return [$locale => $parts];
		});

		if (!$translate->has($fallback)) {
			$translate->prepend([
				$this->getDefaultTranslationLabel(
					$this->getClassName()
				)
			], $fallback);
		}

		return $translate;
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateModifiers()
	{
		return collect(
			$this->option('translate-modifier')
		)->mapWithKeys(function ($string) {
			$parts = explode(':', $string);

			$locale = Str::slug((string)array_shift($parts));

			return [
				$locale => implode('/', $parts)
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateFields()
	{
		return collect(
			$this->option('translate-field')
		)->mapWithKeys(function ($string) {
			$parts = explode(':', $string);

			$field = Str::snake((string)array_shift($parts));

			$locale = Str::slug((string)array_shift($parts));

			return [
				$field => [
					$locale => (string)array_shift($parts)
				]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateBelongsToRelations()
	{
		/** @var Collection $belongsTo */
		$belongsTo = $this->getBelongsTo();

		return collect(
			$this->option('translate-belongs-to')
		)->mapWithKeys(function ($string) use ($belongsTo) {
			$parts = explode(':', $string);

			$relation = Str::singular(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			$field = $belongsTo->first(function ($field) use ($relation) {
				return $field->relation === $relation;
			});

			$relationColumn = $field ? $field->relation_column : 'name';

			return [
				"{$relation}.{$relationColumn}" => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateBelongsToManyRelations()
	{
		/** @var Collection $belongsToMany */
		$belongsToMany = $this->getBelongsToMany();

		return collect(
			$this->option('translate-belongs-to-many')
		)->mapWithKeys(function ($string) use ($belongsToMany) {
			$parts = explode(':', $string);

			$relation = Str::plural(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			$field = $belongsToMany->first(function ($field) use ($relation) {
				return $field->relation === $relation;
			});

			$relationColumn = $field ? $field->relation_column : 'name';

			return [
				"{$relation}.{$relationColumn}" => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateBelongsToManyPivotRelations()
	{
		return collect(
			$this->option('translate-belongs-to-many-pivot')
		)->mapWithKeys(function ($string) {
			$parts = explode(':', $string);

			$relation = Str::plural(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			$relationColumn = Str::snake((string)array_shift($parts));

			return [
				"{$relation}.{$relationColumn}" => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateHasOneRelations()
	{
		return collect(
			$this->option('translate-has-one')
		)->mapWithKeys(function ($string) {
			$parts = explode(':', $string);

			$relation = Str::singular(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			return [
				$relation => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateHasManyRelations()
	{
		return collect(
			$this->option('translate-has-many')
		)->mapWithKeys(function ($string) {
			$parts = explode(':', $string);

			$relation = Str::plural(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			return [
				$relation => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 * @todo $this->option('translate-has-many-through')
	 */
	protected function getTranslateHasManyThroughRelations()
	{
		return collect(
			$this->option('translate-has-many-through')
		)->mapWithKeys(function ($string) {
			$parts = explode(':', $string);

			$relation = Str::plural(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			return [
				$relation => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateMorphToRelations()
	{
		/** @var Collection $morphTo */
		$morphTo = $this->getMorphTo();

		return collect(
			$this->option('translate-morph-to')
		)->mapWithKeys(function ($string) use ($morphTo) {
			$parts = explode(':', $string);

			$relation = Str::singular(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			$field = $morphTo->first(function ($field) use ($relation) {
				return $field->relation === $relation;
			});

			$relationColumn = $field ? $field->relation_column : 'name';

			return [
				"{$relation}.{$relationColumn}" => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateMorphOneRelations()
	{
		/** @var Collection $morphOne */
		$morphOne = $this->getMorphOne();

		return collect(
			$this->option('translate-morph-one')
		)->mapWithKeys(function ($string) use ($morphOne) {
			$parts = explode(':', $string);

			$relation = Str::singular(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			$field = $morphOne->first(function ($field) use ($relation) {
				return $field->relation === $relation;
			});

			$relationColumn = $field ? $field->relation_column : 'name';

			return [
				"{$relation}.{$relationColumn}" => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateMorphManyRelations()
	{
		/** @var Collection $morphMany */
		$morphMany = $this->getMorphMany();

		return collect(
			$this->option('translate-morph-many')
		)->mapWithKeys(function ($string) use ($morphMany) {
			$parts = explode(':', $string);

			$relation = Str::plural(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			$field = $morphMany->first(function ($field) use ($relation) {
				return $field->relation === $relation;
			});

			$relationColumn = $field ? $field->relation_column : 'name';

			return [
				"{$relation}.{$relationColumn}" => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateMorphToManyRelations()
	{
		/** @var Collection $morphToMany */
		$morphToMany = $this->getMorphToMany();

		return collect(
			$this->option('translate-morph-to-many')
		)->mapWithKeys(function ($string) use ($morphToMany) {
			$parts = explode(':', $string);

			$relation = Str::plural(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			$field = $morphToMany->first(function ($field) use ($relation) {
				return $field->relation === $relation;
			});

			$relationColumn = $field ? $field->relation_column : 'name';

			return [
				"{$relation}.{$relationColumn}" => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateMorphedByManyRelations()
	{
		/** @var Collection $morphedByMany */
		$morphedByMany = $this->getMorphedByMany();

		return collect(
			$this->option('translate-morphed-by-many')
		)->mapWithKeys(function ($string) use ($morphedByMany) {
			$parts = explode(':', $string);

			$relation = Str::plural(Str::camel((string)array_shift($parts)));

			$locale = Str::slug((string)array_shift($parts));

			$field = $morphedByMany->first(function ($field) use ($relation) {
				return $field->relation === $relation;
			});

			$relationColumn = $field ? $field->relation_column : 'name';

			return [
				"{$relation}.{$relationColumn}" => [$locale => $parts]
			];
		});
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateRelations()
	{
		return collect(
			array_merge(
				$this->getTranslateBelongsToRelations()->toArray(),
				$this->getTranslateBelongsToManyRelations()->toArray(),
				$this->getTranslateBelongsToManyPivotRelations()->toArray(),
				$this->getTranslateHasOneRelations()->toArray(),
				$this->getTranslateHasManyRelations()->toArray(),
				$this->getTranslateHasManyThroughRelations()->toArray(),
				$this->getTranslateMorphToRelations()->toArray(),
				$this->getTranslateMorphOneRelations()->toArray(),
				$this->getTranslateMorphManyRelations()->toArray(),
				$this->getTranslateMorphToManyRelations()->toArray(),
				$this->getTranslateMorphedByManyRelations()->toArray()
			)
		);
	}

	/**
	 * @return Collection
	 */
	protected function getTranslateLocales()
	{
		return $this->getTranslate()->keys();
	}

	/**
	 * @param string $locale
	 * @param string $modifier
	 * @return array
	 */
	protected function getTranslateLabels($locale, $modifier = '')
	{
		return (array)$this->getTranslate()->get($locale, []);
	}

	/**
	 * @param array $labels
	 * @param integer $case
	 * @param string $fallback
	 * @return string
	 */
	protected function dumpTranslateLabels(array $labels = [], $case = 0, $fallback = '')
	{
		if (count($labels)) {
			return isset($labels[$case]) ? (string)$labels[$case] : $fallback;
		}

		return $fallback;
	}


	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getTranslationOptions()
	{
		return [
			['translate', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource translations.'],

			['translate-modifier', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource translations modifier.'],

			['translate-field', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource fields translations.'],

			['translate-belongs-to', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource One-to-Many (Inverse) relations translations.'],

			['translate-belongs-to-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource Many-to-Many relations translations.'],

			['translate-belongs-to-many-pivot', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource Many-to-Many relations pivot fields translations.'],

			['translate-belongs-to-many-pivot-timestamps', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource Many-to-Many relations pivot timestamps fields translations.'],

			['translate-has-one', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource One-to-One relations translations.'],

			['translate-has-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource Many-to-One relations translations.'],

			['translate-has-many-through', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource Many-to-One relations translations.'],

			['translate-morph-to', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Resource Polymorphic parent relation translations.'],

			['translate-morph-one', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource One To One Polymorphic relations translations.'],

			['translate-morph-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource One To Many Polymorphic relations translations.'],

			['translate-morph-to-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource Many To Many Polymorphic relations translations.'],

			['translate-morphed-by-many', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Resource Inverse Of Many To Many Polymorphic relations translations.'],
		];
	}
}
