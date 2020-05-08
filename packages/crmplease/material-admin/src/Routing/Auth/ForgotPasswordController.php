<?php

namespace Crmplease\MaterialAdmin\Routing\Auth;

use Crmplease\MaterialAdmin\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset emails and
	| includes a trait which assists in sending these notifications from
	| your application to your users. Feel free to explore this trait.
	|
	*/

	use SendsPasswordResetEmails;

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
	protected $rules = [
		'email' => 'required|email'
	];

	/**
	 * Get the broker to be used during password reset.
	 *
	 * @return \Illuminate\Contracts\Auth\PasswordBroker
	 */
	public function broker()
	{
		return Password::broker($this->prefix);
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
	 * Display the form to request a password reset link.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLinkRequestForm()
	{
		return view(sprintf('%s::auth.passwords.email', $this->prefix));
	}

	/**
	 * Validate the email for the given request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return void
	 */
	protected function validateEmail(Request $request)
	{
		$request->validate($this->rules);
	}
}
