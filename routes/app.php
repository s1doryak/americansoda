<?php

/*
|--------------------------------------------------------------------------
| App Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'web'], function () {

    Route::group(['prefix' => 'app'], function () {

        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('app.login');
        Route::post('login', 'Auth\LoginController@login');
        Route::any('logout', 'Auth\LoginController@logout')->name('app.logout');

        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('app.register');
        Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('app.password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('app.password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('app.password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('app.password.update');

        // Email Verification Routes...
        Route::get('email/verify', 'Auth\VerificationController@show')->name('app.verification.notice');
        Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('app.verification.verify');
        Route::get('email/resend', 'Auth\VerificationController@resend')->name('app.verification.resend');

        foreach (get_route_resources() as $resource => $controller) {

            if (!class_exists(sprintf('%s\%s', get_controller_namespace('app'), $controller))) {
                continue;
            }

            Route::put("{$resource}/{{$resource}}/restore", [
                'as' => sprintf("%s.{$resource}.restore", 'app'),
                'uses' => "{$controller}@restore"
            ]);

            Route::get("{$resource}/trashed", [
                'as' => sprintf("%s.{$resource}.trashed", 'app'),
                'uses' => "{$controller}@trashed"
            ]);

            Route::resource($resource, $controller, ['as' => 'app']);

        }

        Route::view('/', 'app::home')->name('app.home');

    });

});
