<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits;

use Hash;

/**
 * Trait PasswordModel
 *
 * @package Crmplease\MaterialAdmin\Database\Eloquent\Traits
 */
trait PasswordModel
{
	/**
	 * Set password/hash attribute.
	 *
	 * @param $value
	 */
	public function setPasswordAttribute($value)
	{
		if (is_bcrypt($value)) {
			$this->attributes['password'] = $value;
		} else {
			$this->attributes['password'] = Hash::make($value);
		}
	}
}