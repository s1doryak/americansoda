<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'web'], function () {

	Route::group(['prefix' => 'dashboard'], function () {

        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('dashboard.login');
        Route::post('login', 'Auth\LoginController@login');
        Route::any('logout', 'Auth\LoginController@logout')->name('dashboard.logout');

        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('dashboard.register');
        Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('dashboard.password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('dashboard.password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('dashboard.password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('dashboard.password.update');

        // Email Verification Routes...
        Route::get('email/verify', 'Auth\VerificationController@show')->name('dashboard.verification.notice');
        Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('dashboard.verification.verify');
        Route::get('email/resend', 'Auth\VerificationController@resend')->name('dashboard.verification.resend');

		foreach (get_route_resources() as $resource => $controller) {

			if (!class_exists(sprintf('%s\%s', get_controller_namespace('dashboard'), $controller))) {
				continue;
			}

			Route::put("{$resource}/{{$resource}}/restore", [
				'as' => sprintf("%s.{$resource}.restore", 'dashboard'),
				'uses' => "{$controller}@restore"
			]);

			Route::get("{$resource}/trashed", [
				'as' => sprintf("%s.{$resource}.trashed", 'dashboard'),
				'uses' => "{$controller}@trashed"
			]);

			Route::resource($resource, $controller, ['as' => 'dashboard']);

		}

		Route::view('/', 'dashboard::home')->name('dashboard');

	});

});
