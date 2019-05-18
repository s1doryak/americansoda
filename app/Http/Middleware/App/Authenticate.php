<?php

namespace App\Http\Middleware\App;

use App\Http\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
	/**
	 * @var string
	 */
	protected $guard = 'app';
}
