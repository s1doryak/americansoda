<?php

namespace Crmplease\MaterialAdmin\Foundation\Auth;

use Crmplease\MaterialAdmin\Database\Eloquent\Model;
use Crmplease\MaterialAdmin\Database\Eloquent\Traits\EmailModel;
use Crmplease\MaterialAdmin\Database\Eloquent\Traits\PasswordModel;
use Crmplease\MaterialAdmin\Foundation\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class User extends Model implements
	AuthenticatableContract,
	AuthorizableContract,
	CanResetPasswordContract,
	HasLocalePreference
{
	use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Notifiable, EmailModel, PasswordModel;

	/**
	 * @return string|null
	 */
	public function preferredLocale()
	{
		return $this->locale;
	}
}
