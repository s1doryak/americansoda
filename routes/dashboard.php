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
        // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('dashboard.register');
        // Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('dashboard.password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('dashboard.password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('dashboard.password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('dashboard.password.update');

        // Email Verification Routes...
        Route::get('email/verify', 'Auth\VerificationController@show')->name('dashboard.verification.notice');
        Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('dashboard.verification.verify');
        Route::get('email/resend', 'Auth\VerificationController@resend')->name('dashboard.verification.resend');

        Route::get('/', [
            'as' => 'dashboard',
            'uses' => 'HomeController@home'
        ]);

        Route::get('/calendar', [
            'as' => 'dashboard.calendar',
            'uses' => 'HomeController@calendar'
        ]);

        Route::get('/calendar.json', [
            'as' => 'dashboard.calendar.json',
            'uses' => 'HomeController@calendarJson'
        ]);

        Route::post('/calendar', [
            'as' => 'dashboard.calendar.update',
            'uses' => 'HomeController@calendarUpdate'
        ]);

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

            if ($resource == 'assembly') {

                Route::get("{$resource}/{{$resource}}/assembly_list", [
                    'as' => sprintf("%s.{$resource}.assembly_list", 'dashboard'),
                    'uses' => "{$controller}@assemblyList"
                ]);

            }

            if ($resource == 'customer_order') {

                Route::get("{$resource}/{{$resource}}/order_review", [
                    'as' => sprintf("%s.{$resource}.order_review", 'dashboard'),
                    'uses' => "{$controller}@orderReview"
                ]);

                Route::get("{$resource}/{{$resource}}/order_review_plain", [
                    'as' => sprintf("%s.{$resource}.order_review_plain", 'dashboard'),
                    'uses' => "{$controller}@orderReviewPlain"
                ]);

                Route::any("{$resource}/{{$resource}}/send_email", [
                    'as' => sprintf("%s.{$resource}.send_email", 'dashboard'),
                    'uses' => "{$controller}@sendEmail"
                ]);

            }

            if ($resource == 'customer_order_item') {

                /**
                 * Split items
                 */
                Route::get("{$resource}/{{$resource}}/split", [
                    'as' => sprintf("%s.{$resource}.split", 'dashboard'),
                    'uses' => "{$controller}@getSplitForm"
                ]);

                Route::post("{$resource}/{{$resource}}/split", [
                    'as' => sprintf("%s.{$resource}.split", 'dashboard'),
                    'uses' => "{$controller}@split"
                ]);

                /**
                 * Assign shipment number
                 */
                Route::get("{$resource}/{{$resource}}/shipment/assign", [
                    'as' => sprintf("%s.{$resource}.shipment.assign", 'dashboard'),
                    'uses' => "{$controller}@getShipmentAssignForm"
                ]);

                Route::post("{$resource}/{{$resource}}/shipment/assign", [
                    'as' => sprintf("%s.{$resource}.shipment.assign", 'dashboard'),
                    'uses' => "{$controller}@shipmentAssign"
                ]);

            }

            if ($resource == 'customer_shipment') {

                Route::get("customer_shipment/{customer_shipment}/package_list", [
                    'as' => sprintf("%s.{$resource}.package_list", 'dashboard'),
                    'uses' => "{$controller}@packageList"
                ]);

                Route::get("customer_shipment/{customer_shipment}/waybill", [
                    'as' => sprintf("%s.{$resource}.waybill", 'dashboard'),
                    'uses' => "{$controller}@waybill"
                ]);

                Route::get("customer_shipment/{customer_shipment}/invoice", [
                    'as' => sprintf("%s.{$resource}.invoice", 'dashboard'),
                    'uses' => "{$controller}@invoice"
                ]);

            }

		}

	});

});
