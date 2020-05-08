<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits;

/**
 * Trait EmailModel
 *
 * @package Crmplease\MaterialAdmin\Database\Eloquent\Traits
 */
trait EmailModel
{
	/**
	 * Get email attribute trimmed and in lowercase.
	 *
	 * @param $value
	 * @return string
	 */
	public function getEmailAttribute($value)
	{
		return trim(strtolower($value));
	}

	/**
	 * Set email attribute trimmed and in lowercase.
	 *
	 * @param $value
	 */
	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = trim(strtolower($value));
	}
}