<?php

namespace Crmplease\MaterialAdmin\Policies\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;

interface DatatablePolicyContract
{
	/**
	 * @param Authenticatable $user
	 * @return mixed
	 */
	public function index(Authenticatable $user);

	/**
	 * @param Authenticatable $user
	 * @return mixed
	 */
	public function action(Authenticatable $user);
}