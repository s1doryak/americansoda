<?php

namespace Crmplease\MaterialAdmin\Http\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class Request extends FormRequest
{
	/**
	 * @var array
	 */
	private $rules = [];

	/**
	 * @var mixed
	 */
	protected $transformer;

	/**
	 * @return boolean
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return $this->rules;
	}

	/**
	 * @return mixed
	 */
	public function transformer()
	{
		return $this->transformer;
	}

	/**
	 * @param array $rules
	 * @return $this
	 */
	public function setRules(array $rules = [])
	{
		$this->rules = $rules;

		return $this;
	}

	/**
	 * @param $transformer
	 * @return $this
	 */
	public function setTransformer($transformer)
	{
		$this->transformer = $transformer;

		return $this;
	}

	/**
	 * @param $action
	 * @return mixed
	 * @throws Exception
	 */
	public function transform($action)
	{
		if (method_exists($this->transformer(), $method = Str::camel(sprintf("transform_%s_request", $action)))) {
			return call_user_func([$this->transformer(), $method], $this);
		}

		throw new Exception(sprintf("No %s transformer method provided.", $method));
	}
}
