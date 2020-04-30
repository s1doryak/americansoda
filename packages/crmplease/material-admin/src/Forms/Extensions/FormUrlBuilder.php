<?php

namespace Crmplease\MaterialAdmin\Forms\Extensions;

use Illuminate\Routing\Router;

class FormUrlBuilder
{
	/**
	 * The resource.
	 *
	 * @var string
	 */
	private $resource;

	/**
	 * The prefix.
	 *
	 * @var string
	 */
	private $prefix;

	/**
	 * The router.
	 *
	 * @var Router
	 */
	private $router;

	/**
	 * FormUrlBuilder constructor.
	 *
	 * @param Router $router
	 */
	public function __construct(Router $router)
	{
		$this->router = $router;
	}

	/**
	 * Build 'store' URL for the resource.
	 *
	 * @return string
	 */
	public function getStoreUrl()
	{
		return $this->getUrl('store');
	}

	/**
	 * Build 'update' URL for the resource.
	 *
	 * @return string
	 */
	public function getUpdateUrl()
	{
		return $this->getUrl('update');
	}

	/**
	 * Build an action URL for the resource.
	 *
	 * @param string $action
	 * @param array $params
	 *
	 * @return string
	 */
	public function getUrl($action, array $params = [])
	{
		if($this->prefix) {
			return route(sprintf('%s.%s.%s', $this->prefix, $this->resource, $action), $this->getRouteParams($action, $params));
		} else {
			return route(sprintf('%s.%s', $this->resource, $action), $this->getRouteParams($action, $params));
		}
	}

	/**
	 * Extract resource parameters of all ancestor resources.
	 *
	 * @param string $action
	 * @param array $other
	 *
	 * @return array
	 */
	private function getRouteParams($action, $other = [])
	{
		$resources = explode('.', $this->resource);
		$length = count($resources);

		if (in_array($action, ['create', 'store'])) {
			$length--;
		}

		$params = [];
		$route = $this->router->getCurrentRoute();

		for ($idx = 0; $idx < $length; $idx++) {
			$params[$resources[$idx]] = $route->parameter($resources[$idx]);
		}

		return array_merge($params, $other);
	}

	/**
	 * Set builder resource.
	 *
	 * @param string $resource
	 *
	 * @return $this
	 */
	public function setResource($resource)
	{
		$this->resource = $resource;

		return $this;
	}

	/**
	 * Set builder prefix.
	 *
	 * @param string $prefix
	 *
	 * @return $this
	 */
	public function setPrefix($prefix)
	{
		$this->prefix = $prefix;

		return $this;
	}
}