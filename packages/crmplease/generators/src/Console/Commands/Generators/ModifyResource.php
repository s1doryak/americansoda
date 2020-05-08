<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Crmplease\Generators\Console\Commands\Contracts\HasModelAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasNamespaceAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasPolicyAttributes;
use Crmplease\Generators\Console\Commands\Contracts\HasSeederAttributes;
use Crmplease\Generators\Console\Commands\Traits\ModelAttributes;
use Crmplease\Generators\Console\Commands\Traits\NamespaceAttributes;
use Crmplease\Generators\Console\Commands\Traits\PolicyAttributes;
use Crmplease\Generators\Console\Commands\Traits\ResourceAttributes;
use Crmplease\Generators\Console\Commands\Traits\SeederAttributes;
use Crmplease\Generators\Console\Commands\Traits\TranslateAttributes;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class ModifyResource extends GeneratorCommand implements HasModelAttributes, HasNamespaceAttributes, HasPolicyAttributes, HasSeederAttributes
{
	use ModelAttributes, NamespaceAttributes, PolicyAttributes, ResourceAttributes, SeederAttributes, TranslateAttributes;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $name = 'modify:resource';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Modify resource';

	/**
	 * @var array
	 */
	protected $defaultLabels = [];

	/**
	 * Get class name.
	 *
	 * @return string
	 */
	protected function getClassName()
	{
		return Str::singular(Str::snake($this->argument('name')));
	}

	/**
	 * @return array
	 */
	public function getNamespaces()
	{
		return array_keys(config('namespaces', []));
	}

	/**
	 * @param string $class
	 * @return string
	 */
	public function getModelFilename($class)
	{
		return sprintf("app/%s.php", Str::studly($class));
	}

	/**
	 * @param string $class
	 * @return string
	 */
	public function getCreatorFilename($class)
	{
		return sprintf("app/Console/Commands/Resources/%sCreator.php", Str::studly($class));
	}


	/**
	 * @param string $class
	 * @return string
	 */
	public function getFactoryFilename($class)
	{
		return sprintf("database/factories/%sFactory.php", Str::studly($class));
	}

	/**
	 * @param string $class
	 * @return string
	 */
	public function getTranslationFilename($locale, $class)
	{
		return sprintf("resources/lang/%s/models/%s.php", $locale, Str::snake($class));
	}

	/**
	 * @param string $namespace
	 * @param string $class
	 * @return string
	 */
	public function getControllerFilename($namespace, $class)
	{
		return sprintf("app/Http/Controllers/%s/%sController.php", Str::studly($namespace), Str::plural(Str::studly($class)));
	}

	/**
	 * @param string $namespace
	 * @param string $class
	 * @return string
	 */
	public function getFormFilename($namespace, $class)
	{
		return sprintf("app/Forms/%s/%sForm.php", Str::studly($namespace), Str::studly($class));
	}

	/**
	 * @param string $namespace
	 * @param string $class
	 * @return string
	 */
	public function getTransformerFilename($namespace, $class)
	{
		return sprintf("app/Transformers/%s/%sTransformer.php", Str::studly($namespace), Str::studly($class));
	}

	/**
	 * @param string $namespace
	 * @param string $class
	 * @return string
	 */
	public function getDataTableFilename($namespace, $class)
	{
		return sprintf("app/DataTables/%s/%sDataTable.php", Str::studly($namespace), Str::studly($class));
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		if (false === $name = $this->handleName()) {
			return false;
		}

		$namespace = $this->handleNamespace(self::DEFAULT_NAMESPACE);

		$class = $this->qualifyModelClass($name);

		$class_phpdoc = class_basename($class);

		$traits = $this->getTraits();

		$fields = $this->getFields();

		$fillable = $this->getFillable();

		$casts = $this->getCasts();

		$dates = $this->getDates();

		$hidden = $this->getHidden();

		$belongsTo = $this->getBelongsTo();

		$belongsToMany = $this->getBelongsToMany();

		$belongsToManyPivot = $this->getBelongsToManyPivot();

		$belongsToManyPivotTimestamps = $this->getBelongsToManyPivotTimestamps();

		$hasOne = $this->getHasOne();

		$hasMany = $this->getHasMany();

		$hasManyThrough = $this->getHasManyThrough();

		$morphTo = $this->getMorphTo();

		$morphOne = $this->getMorphOne();

		$morphMany = $this->getMorphMany();

		$morphToMany = $this->getMorphToMany();

		$morphedByMany = $this->getMorphedByMany();

		$images = $this->getImages();

		$files = $this->getFiles();

		$touches = $this->getTouches();

		$with = $this->getWith();

		if ($this->modelEnabled()) {
			if ($this->isAuthResource()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'class_extends',
					sprintf("class %s extends \Crmplease\MaterialAdmin\Foundation\Auth\User\n{", Str::studly($name)),
					0,
					'class_extends'

				);

				$this->updateCodeSuggestion(
					'config/auth.php',
					'guards',
					sprintf(
						"'%s' => [\n\t'driver' => 'session',\n\t'provider' => '%s',\n],",
						Str::snake($this->option('namespace')),
						Str::camel(Str::plural($this->argument('name')))
					),
					2
				);

				$this->updateCodeSuggestion(
					'config/auth.php',
					'providers',
					sprintf(
						"'%s' => [\n\t'driver' => 'eloquent',\n\t'model' => \App\%s::class,\n],",
						Str::camel(Str::plural($this->argument('name'))),
						Str::studly($this->argument('name'))
					),
					2
				);

				$this->updateCodeSuggestion(
					'config/auth.php',
					'passwords',
					sprintf(
						"'%s' => [\n\t'provider' => '%s',\n\t'table' => '%s_password_resets',\n\t'expire' => 60,\n],",
						Str::snake($this->option('namespace')),
						Str::camel(Str::plural($this->argument('name'))),
						Str::camel(Str::plural($this->argument('name')))
					),
					2
				);
			}

			if ($fields->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocProperties($fields),
					0,
					'class_phpdoc'
				);
			}

			if ($traits->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'use',
					$this->dumpTraits($traits),
					2,
					'class_traits'
				);
			}

			if ($fillable->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$fillable',
					$this->dumpFillable($fillable),
					2,
					'array_var'
				);
			}

			if ($casts->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$casts',
					$this->dumpCasts($casts),
					2,
					'array_var'
				);
			}

			if ($dates->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$dates',
					$this->dumpDates($dates),
					2,
					'array_var'
				);
			}

			if ($hidden->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$hidden',
					$this->dumpHidden($hidden),
					2,
					'array_var'
				);
			}

			if ($belongsTo->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocBelongsToProperties($belongsTo),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocBelongsToMethods($belongsTo),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$belongsTo',
					$this->dumpBelongsTo($belongsTo),
					2,
					'array_var'
				);
			}

			if ($belongsToMany->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocBelongsToManyProperties($belongsToMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocBelongsToManyMethods($belongsToMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$belongsToMany',
					$this->dumpBelongsToMany($belongsToMany),
					2,
					'array_var'
				);
			}

			if ($belongsToManyPivot->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$belongsToManyPivot',
					$this->dumpBelongsToManyPivot($belongsToManyPivot),
					2,
					'array_var'
				);
			}

			if ($belongsToManyPivotTimestamps->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$belongsToManyPivotTimestamps',
					$this->dumpBelongsToManyPivotTimestamps($belongsToManyPivotTimestamps),
					2,
					'array_var'
				);
			}

			if ($hasOne->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocHasOneProperties($hasOne),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocHasOneMethods($hasOne),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$hasOne',
					$this->dumpHasOne($hasOne),
					2,
					'array_var'
				);
			}

			if ($hasMany->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocHasManyProperties($hasMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocHasManyMethods($hasMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$hasMany',
					$this->dumpHasMany($hasMany),
					2,
					'array_var'
				);
			}

			if ($hasManyThrough->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocHasManyThroughProperties($hasManyThrough),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocHasManyThroughMethods($hasManyThrough),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$hasManyThrough',
					$this->dumpHasManyThrough($hasManyThrough),
					2,
					'array_var'
				);
			}

			if ($morphTo->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphToProperties($morphTo),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphToMethods($morphTo),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$morphTo',
					$this->dumpMorphTo($morphTo),
					2,
					'array_var'
				);
			}

			if ($morphOne->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphOneProperties($morphOne),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphOneMethods($morphOne),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$morphOne',
					$this->dumpMorphOne($morphOne),
					2,
					'array_var'
				);
			}

			if ($morphMany->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphManyProperties($morphMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphManyMethods($morphMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$morphMany',
					$this->dumpMorphMany($morphMany),
					2,
					'array_var'
				);
			}

			if ($morphToMany->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphToManyProperties($morphToMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphToManyMethods($morphToMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$morphToMany',
					$this->dumpMorphToMany($morphToMany),
					2,
					'array_var'
				);
			}

			if ($morphedByMany->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphedByManyProperties($morphedByMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocMorphedByManyMethods($morphedByMany),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$morphedByMany',
					$this->dumpMorphedByMany($morphedByMany),
					2,
					'array_var'
				);
			}

			if ($images->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocProperties($images),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$images',
					$this->dumpImages($images),
					2,
					'array_var'
				);
			}

			if ($files->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					$class_phpdoc,
					$this->dumpPhpDocProperties($files),
					0,
					'class_phpdoc'
				);
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$files',
					$this->dumpFiles($files),
					2,
					'array_var'
				);
			}

			if ($with->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$with',
					$this->dumpWith($with),
					2,
					'array_var'
				);
			}

			if ($touches->count()) {
				$this->updateCodeSuggestion(
					$this->getModelFilename($name),
					'$touches',
					$this->dumpTouches($touches),
					2,
					'array_var'
				);
			}
		} else {
			$this->line('Skipping model modification.');
		}

		if ($this->controllerEnabled()) {

			$repositories = $this->getRepositories()->slice(1);

			$properties = $this->getProperties();

			$formConfigData = $this->getFormConfigData();

			if ($repositories->count()) {
				$this->updateCodeSuggestion(
					$this->getControllerFilename($namespace, $name),
					'use',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpRepositories($repositories)
					),
					0,
					'class_use'
				);

				$this->updateCodeSuggestion(
					$this->getControllerFilename($namespace, $name),
					'__construct',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpConstructorPhpDoc($repositories)
					),
					1,
					'func_phpdoc'
				);

				$this->updateCodeSuggestion(
					$this->getControllerFilename($namespace, $name),
					'__construct',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpConstructorSignature($repositories)
					),
					2,
					'func_args'
				);
			}

			if ($properties->count()) {
				$this->updateCodeSuggestion(
					$this->getControllerFilename($namespace, $name),
					'property',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpProperties($properties)
					),
					1,
					'class_property'
				);

				$this->updateCodeSuggestion(
					$this->getControllerFilename($namespace, $name),
					'__construct',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpConstructorBody($properties, false)
					),
					2,
					'func_body'

				);

				$this->updateCodeSuggestion(
					$this->getControllerFilename($namespace, $name),
					'$editActionFormData',
					$this->dumpFormConfigData($formConfigData),
					2,
					'array_var'
				);
			}

		} else {
			$this->line('Skipping controller modification.');
		}

		if ($this->formEnabled()) {

			$formFields = $this->getFormFields();

			if ($formFields->count()) {
				$this->updateCodeSuggestion(
					$this->getFormFilename($namespace, $name),
					'getCreateFormFields',
					$this->dumpFormFields($formFields),
					3,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getFormFilename($namespace, $name),
					'getEditFormFields',
					$this->dumpFormFields($formFields),
					3,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getFormFilename($namespace, $name),
					'getStoreValidationRules',
					$this->dumpStoreValidationRules($formFields),
					3,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getFormFilename($namespace, $name),
					'getUpdateValidationRules',
					$this->dumpUpdateValidationRules($formFields),
					3,
					'array_return'
				);
			}

		} else {
			$this->line('Skipping form modification.');
		}

		if ($this->transformerEnabled()) {

			$transformerFields = $this->getTransformerFields();
			$transformerRelations = $this->getBelongsTo();
			$transformerManyRelations = $this->getBelongsToMany();

			if ($transformerFields->count()) {

				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'transformStoreRequest',
					$this->dumpTransformerRequestFields($transformerFields),
					2,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'transformUpdateRequest',
					$this->dumpTransformerRequestFields($transformerFields),
					2,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'toArray',
					$this->dumpTransformerToArrayFields($transformerFields),
					2,
					'array_return'
				);
			}

			if ($transformerRelations->count()) {
				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'transformStoreRequest',
					$this->dumpTransformerRequestRelations($transformerRelations),
					2,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'transformUpdateRequest',
					$this->dumpTransformerRequestRelations($transformerRelations),
					2,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'toArray',
					$this->dumpTransformerToArrayRelations($transformerRelations),
					2,
					'array_return'
				);
			}

			if ($transformerManyRelations->count()) {
				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'transformStoreRequest',
					$this->dumpTransformerRequestManyRelations($transformerManyRelations),
					2,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'transformUpdateRequest',
					$this->dumpTransformerRequestManyRelations($transformerManyRelations),
					2,
					'array_return'
				);

				$this->updateCodeSuggestion(
					$this->getTransformerFilename($namespace, $name),
					'toArray',
					$this->dumpTransformerToArrayManyRelations($transformerManyRelations),
					2,
					'array_return'
				);
			}

		} else {
			$this->line('Skipping transformer modification.');
		}

		if ($this->datatableEnabled()) {

			$datatableColumns = $this->getDatatablesColumns();
			$datatableAggregateColumns = $this->getDatatablesAggregateColumns();
			$datatableFilterableColumns = $this->getDatatablesFilterableColumns();

			if ($datatableColumns->count()) {
				$this->updateCodeSuggestion(
					$this->getDataTableFilename($namespace, $name),
					'getColumns',
					$this->dumpDatatablesColumns($datatableColumns),
					2,
					'array_return'
				);
			}

			if ($datatableColumns->count()) {
				$this->updateCodeSuggestion(
					$this->getDataTableFilename($namespace, $name),
					'getRawColumns',
					$this->dumpDatatablesRawColumns($datatableColumns),
					2,
					'array_return'
				);
			}

			if ($datatableAggregateColumns->count()) {
				$this->updateCodeSuggestion(
					$this->getDataTableFilename($namespace, $name),
					'getAggregateColumns',
					$this->dumpDatatablesAggregateColumns($datatableAggregateColumns),
					2,
					'array_return'
				);
			}

			if ($datatableFilterableColumns->count()) {
				$this->updateCodeSuggestion(
					$this->getDataTableFilename($namespace, $name),
					'getFilterableColumns',
					$this->dumpDatatablesFilterableColumns($datatableFilterableColumns),
					2,
					'array_return'
				);
			}

		} else {
			$this->line('Skipping datatable modification.');
		}

		if ($this->factoryEnabled()) {

			$factoryFields = $this->getFactoryFields();

			if ($factoryFields->count()) {
				$this->updateCodeSuggestion(
					$this->getFactoryFilename($name),
					'$factory->define',
					$this->dumpFactoryFields($factoryFields),
					2,
					'array_return'
				);
			}

		} else {
			$this->line('Skipping factory modification.');
		}

		if ($this->translationEnabled()) {

			$modifiers = $this->getTranslateModifiers();
			$translationFields = $this->getTranslationFields();
			$translationRelations = $this->getTranslationRelations();
			$translationPlaceholders = $this->getTranslationPlaceholders();

			foreach ($this->getTranslateLocales() as $locale) {

				$modifier = $modifiers->has($locale) ? $modifiers->get($locale) : '';

				if ($translationFields->count()) {
					$this->updateCodeSuggestion(
						$this->getTranslationFilename($locale, $name),
						'fields',
						$this->dumpTranslationFields($translationFields, $locale, $modifier),
						2,
						'comment'
					);

					$this->updateCodeSuggestion(
						$this->getTranslationFilename($locale, $name),
						'columns',
						$this->dumpTranslationFields($translationFields, $locale, $modifier),
						2,
						'comment'
					);
				}

				if ($translationRelations->count()) {
					$this->updateCodeSuggestion(
						$this->getTranslationFilename($locale, $name),
						'fields',
						$this->dumpTranslationRelations($translationRelations, $locale, $modifier, 0),
						2,
						'comment'
					);

					$this->updateCodeSuggestion(
						$this->getTranslationFilename($locale, $name),
						'columns',
						$this->dumpTranslationRelations($translationRelations, $locale, $modifier, 0),
						2,
						'comment'
					);

					$this->updateCodeSuggestion(
						$this->getTranslationFilename($locale, $name),
						'filters',
						$this->dumpTranslationRelations($translationRelations, $locale, $modifier, 0),
						2,
						'comment'
					);
				}

				if ($translationPlaceholders->count()) {
					$this->updateCodeSuggestion(
						$this->getTranslationFilename($locale, $name),
						'placeholders',
						$this->dumpTranslationPlaceholders($translationPlaceholders, $locale, $modifier, 1),
						2,
						'comment'
					);
				}

			}

		} else {
			$this->line('Skipping translation modification.');
		}

		if ($this->creatorEnabled()) {

			$repositories = $this->getRepositories()->slice(1);

			$properties = $this->getProperties();

			$findOrCreateData = $this->getFindOrCreateData();

			if ($repositories->count()) {
				$this->updateCodeSuggestion(
					$this->getCreatorFilename($name),
					'use',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpRepositories($repositories)
					),
					0,
					'class_use'
				);

				$this->updateCodeSuggestion(
					$this->getCreatorFilename($name),
					'__construct',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpConstructorSignature($repositories)
					),
					2,
					'func_args'
				);
			}

			if ($properties->count()) {
				$this->updateCodeSuggestion(
					$this->getCreatorFilename($name),
					'property',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpProperties($properties)
					),
					1,
					'class_property'
				);

				$this->updateCodeSuggestion(
					$this->getCreatorFilename($name),
					'__construct',
					sprintf(
						implode("\n", [
							"%s",
						]),
						$this->dumpConstructorBody($properties, false)
					),
					2,
					'func_body'

				);

				$this->updateCodeSuggestion(
					$this->getCreatorFilename($name),
					'$findOrCreateData',
					$this->dumpFindOrCreateData($findOrCreateData),
					2,
					'array_var'
				);
			}

		} else {
			$this->line('Skipping resource creator modification.');
		}

		if ($this->migrationEnabled()) {

			if ($this->isAuthResource() || $this->hasFields() || $this->hasBelongsTo() || $this->hasMorphTo()) {

				$this->call(
					'generate:migration',
					[
						'name' => $name,
						'--update' => true,
						'--auth' => $this->option('auth'),
						'--field' => $this->option('field'),
						'--belongs-to' => $this->option('belongs-to'),
						'--morph-to' => $this->option('morph-to'),
					]
				);

				if ($this->isAuthResource()) {

					sleep(1);

					$this->call(
						'generate:migration:password_resets',
						[
							'name' => $name,
						]
					);
				}
			}

			$this->getBelongsToMany()->each(
				function ($relation) use ($name) {

					sleep(1);

					$this->call(
						'generate:migration:pivot',
						[
							'a' => $name,
							'b' => class_basename($relation->model),
							'--belongs-to-many' => $this->option('belongs-to-many'),
							'--belongs-to-many-pivot' => $this->option('belongs-to-many-pivot'),
							'--belongs-to-many-pivot-timestamps' => $this->option('belongs-to-many-pivot-timestamps'),
						]
					);

				}
			);

		} else {
			$this->line('Skipping migrations modification.');
		}

		if ($this->policyEnabled()) {

			//- [ ] Поля для Policy

		} else {
			$this->line('Skipping policy modification.');
		}

		if ($this->seederEnabled()) {

			//- [ ] Поля для Seeder

		} else {
			$this->line('Skipping seeder modification.');
		}

		if ($this->dumpComposerEnabled()) {
			$this->dumpComposer();
		}

		return true;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['name', InputArgument::OPTIONAL, 'The name of the resource.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array_merge(
			$this->getNamespaceOptions(),
			$this->getResourceOptions(),
			$this->getModelOptions(),
			$this->getPolicyOptions(),
			$this->getSeederOptions(),
			$this->getTranslationOptions(),
			$this->getGeneratorOptions()
		);
	}
}
