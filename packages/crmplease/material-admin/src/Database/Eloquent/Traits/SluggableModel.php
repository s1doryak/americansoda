<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits;

/**
 * Trait SluggableModel
 *
 * @package Crmplease\MaterialAdmin\Database\Eloquent\Traits
 */
trait SluggableModel
{
	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}
}