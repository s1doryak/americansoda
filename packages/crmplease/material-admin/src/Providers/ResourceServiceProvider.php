<?php

namespace Crmplease\MaterialAdmin\Providers;

use Exception;
use Crmplease\MaterialAdmin\Forms\Extensions\FormBuilder;
use Crmplease\MaterialAdmin\Forms\Extensions\FormUrlBuilder;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;

/**
 * Resource service provider.
 *
 * @package Crmplease\MaterialAdmin\Providers
 */
class ResourceServiceProvider
{
	/**
	 * @var string
	 */
	private $resource;

	/**
	 * @var string
	 */
	private $prefix;

	/**
	 * @var string
	 */
	private $model;

	/**
	 * @var FormBuilder
	 */
	private $formBuilder;

	/**
	 * @var FormUrlBuilder
	 */
	private $urlBuilder;

	/**
	 * @var Router
	 */
	private $router;

	/**
	 * ResourceServiceProvider constructor.
	 *
	 * @param string $resource
	 * @param FormBuilder $formBuilder
	 * @param FormUrlBuilder $urlBuilder
	 * @param Router $router
	 */
	public function __construct(
		$resource,
		$prefix,
		FormBuilder $formBuilder,
		FormUrlBuilder $urlBuilder,
		Router $router
	)
	{
		$this->resource = $resource;
		$this->prefix = $prefix;
		$this->formBuilder = $formBuilder;
		$this->urlBuilder = $urlBuilder;
		$this->router = $router;
		$this->model = null;

		$this->urlBuilder->setResource($this->resource)->setPrefix($this->prefix);
	}

	/**
	 * @param $model
	 *
	 * @return $this
	 */
	public function setModel($model)
	{
		$this->model = $model;

		return $this;
	}

	/**
	 * @return FormUrlBuilder
	 */
	public function getUrlBuilder()
	{
		return $this->urlBuilder;
	}

	/**
	 * @return FormBuilder
	 */
	public function getFormBuilder()
	{
		return $this->formBuilder;
	}

	/**
	 * Build create form options.
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	private function getCreateFormOptions(array $options = [])
	{
		return array_merge(
			$this->getDefaultFormOptions(),
			[
				'url' => $this->urlBuilder->getStoreUrl(),
				'method' => 'post',
				'files' => true,
			],
			$options
		);
	}

	/**
	 * Build update form options.
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	private function getEditFormOptions(array $options = [])
	{
		return array_merge(
			$this->getDefaultFormOptions(),
			[
				'url' => $this->urlBuilder->getUpdateUrl(),
				'method' => 'put',
				'files' => true,
			],
			$options
		);
	}

	/**
	 * @param array $options
	 *
	 * @return array
	 */
	private function getDefaultFormOptions()
	{
		return [
			'id' => sprintf('%s-%s', str_replace('_', '-', $this->resource), 'form'),
			'submit' => !is_ajax()
		];
	}

	/**
	 * Build form class name from the model class name.
	 *
	 * @return string
	 */
	private function buildFormClass()
	{
		return sprintf('App\\Forms\\%s\\%sForm', Str::studly($this->prefix), Str::studly($this->resource));
	}

	/**
	 * Build transformer class name from the model class name.
	 *
	 * @return string
	 */
	private function buildTransformerClass()
	{
		return sprintf('App\\Transformers\\%s\\%sTransformer', Str::studly($this->prefix), Str::studly($this->resource));
	}

	/**
	 * Build form.
	 *
	 * @uses ResourceServiceProvider::getCreateFormOptions()
	 * @uses ResourceServiceProvider::getEditFormOptions()
	 *
	 * @param string $action
	 * @param array $options
	 * @param array $data
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function getForm($action, array $options, array $data)
	{
		if (class_exists($form = $this->buildFormClass())) {

			$options['action'] = $action;
			$options['resource'] = $this->resource;

			if (method_exists($this, $optionsMethod = Str::camel(sprintf('get_%s_form_options', $action)))) {
				$options = array_merge(call_user_func([$this, $optionsMethod]), $options);
			}

			if (method_exists($form, $optionsMethod = Str::camel(sprintf('get_%s_form_options', $action)))) {
				$options = array_merge(call_user_func([$form, $optionsMethod]), $options);
			}

			if (method_exists($form, $fieldsMethod = Str::camel(sprintf('get_%s_form_fields', $action)))) {
				$options['fields'] = call_user_func(
					[$form, $fieldsMethod],
					$this->model
				);
			}

			return $this->formBuilder->create($form, $options, $data);

		}

		throw new Exception(sprintf("No %s form specified.", $action));
	}

	/**
	 * Provide form request for input validation.
	 *
	 * @param string $action
	 *
	 * @return Request
	 * @throws \Exception
	 */
	public function getRequest($action)
	{
		/** @var Request $request */
		$request = app(Request::class)->createFromBase(
			app(Router::class)->getCurrentRequest()
		);

		if (class_exists($form = $this->buildFormClass())) {
			if (method_exists($form, $rulesMethod = Str::camel(sprintf('get_%s_validation_rules', $action)))) {
				$request->setRules(call_user_func([$form, $rulesMethod], $this->model));
			}
		}

		if (class_exists($transformer = $this->buildTransformerClass())) {
			$request->setTransformer(new $transformer);
		}

		return $request;
	}
}