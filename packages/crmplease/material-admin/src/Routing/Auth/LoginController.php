<?php

namespace Crmplease\MaterialAdmin\Routing\Auth;

use Crmplease\MaterialAdmin\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * @var string
	 */
	protected $prefix;

	/**
	 * @var string
	 */
	protected $defaultMiddleware = 'guest';

	/**
	 * @var array
	 */
	protected $defaultMiddlewareOptions = ['except' => 'logout'];

	/**
	 * @var string
	 */
	protected $username = 'email';

	/**
	 * @var array
	 */
	protected $rules = [
		'email' => 'required|string',
		'password' => 'required|string',
	];

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function username()
	{
		return $this->username;
	}

	/**
	 * Get the guard to be used during authentication.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard()
	{
		return Auth::guard($this->prefix);
	}

	/**
	 * Validate the user login request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return void
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function validateLogin(Request $request)
	{
		$request->validate($this->rules);
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		return route($this->prefix);
	}

	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLoginForm()
	{
		return view(sprintf('%s::auth.login', $this->prefix));
	}

	/**
	 * Log the user out of the application.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout(Request $request)
	{
		$this->guard()->logout();

		$request->session()->flush();

		$request->session()->regenerate();

		return redirect($this->redirectPath());
	}
}
