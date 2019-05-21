<?php

namespace App\Http\Middleware\Dashboard;

use App\Http\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
	/**
	 * @var string
	 */
	protected $guard = 'dashboard';
}
