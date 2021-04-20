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
                'as' => "dashboard.{$resource}.restore",
                'uses' => "{$controller}@restore"
            ]);

            Route::get("{$resource}/trashed", [
                'as' => "dashboard.{$resource}.trashed",
                'uses' => "{$controller}@trashed"
            ]);

            Route::resource($resource, $controller, ['as' => 'dashboard']);

            if ($resource == 'assembly') {

                Route::get("{$resource}/{{$resource}}/assembly_list", [
                    'as' => "dashboard.{$resource}.assembly_list",
                    'uses' => "{$controller}@assemblyList"
                ]);

            }

            if ($resource == 'customer_order') {

                Route::get("{$resource}/{{$resource}}/order_review", [
                    'as' => "dashboard.{$resource}.order_review",
                    'uses' => "{$controller}@orderReview"
                ]);

                Route::get("{$resource}/{{$resource}}/order_review_plain", [
                    'as' => "dashboard.{$resource}.order_review_plain",
                    'uses' => "{$controller}@orderReviewPlain"
                ]);

                Route::any("{$resource}/{{$resource}}/send_email", [
                    'as' => "dashboard.{$resource}.send_email",
                    'uses' => "{$controller}@sendEmail"
                ]);

            }

            if ($resource == 'customer_order_item') {

                /**
                 * Split items
                 */
                Route::get("{$resource}/{{$resource}}/split", [
                    'as' => "dashboard.{$resource}.split",
                    'uses' => "{$controller}@getSplitForm"
                ]);

                Route::post("{$resource}/{{$resource}}/split", [
                    'as' => "dashboard.{$resource}.split",
                    'uses' => "{$controller}@split"
                ]);

                /**
                 * Assign shipment number
                 */
                Route::get("{$resource}/{{$resource}}/shipment/assign", [
                    'as' => "dashboard.{$resource}.shipment.assign",
                    'uses' => "{$controller}@getShipmentAssignForm"
                ]);

                Route::post("{$resource}/{{$resource}}/shipment/assign", [
                    'as' => "dashboard.{$resource}.shipment.assign",
                    'uses' => "{$controller}@shipmentAssign"
                ]);

            }

            if ($resource == 'customer_shipment') {

                Route::get("customer_shipment/{customer_shipment}/package_list", [
                    'as' => "dashboard.{$resource}.package_list",
                    'uses' => "{$controller}@packageList"
                ]);

                Route::get("customer_shipment/{customer_shipment}/waybill", [
                    'as' => "dashboard.{$resource}.waybill",
                    'uses' => "{$controller}@waybill"
                ]);

                Route::get("customer_shipment/{customer_shipment}/invoice", [
                    'as' => "dashboard.{$resource}.invoice",
                    'uses' => "{$controller}@invoice"
                ]);

                Route::get("customer_shipment/{customer_shipment}/send_to_ltp", [
                    'as' => "dashboard.{$resource}.sendToLtp",
                    'uses' => "{$controller}@sendToLtp"
                ]);

            }

            if ($resource == 'customer_invoice') {

                Route::get("customer_invoice/{customer_invoice}/invoice", [
                    'as' => "dashboard.{$resource}.invoice",
                    'uses' => "{$controller}@invoice"
                ]);

                Route::post("customer_invoice/{customer_invoice}/maventa_paid", [
                    'as' => "dashboard.{$resource}.maventa_paid",
                    'uses' => "{$controller}@maventaPaid"
                ]);

                Route::post("customer_invoice/{customer_invoice}/maventa_sent_at", [
                    'as' => "dashboard.{$resource}.maventa_sent_at",
                    'uses' => "{$controller}@maventaSentAt"
                ]);

                Route::any("{$resource}/{{$resource}}/send_email", [
                    'as' => "dashboard.{$resource}.send_email",
                    'uses' => "{$controller}@sendEmail"
                ]);

            }

            if ($resource == 'customer_user') {
                Route::get("customer_user/{customer_user}/update_token", [
                    'as' => "dashboard.{$resource}.update_token",
                    'uses' => "{$controller}@updateToken"
                ]);
            }

        }

    });

});
