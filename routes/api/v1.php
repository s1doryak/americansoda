<?php

/*
|--------------------------------------------------------------------------
| Api/V1 Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BannersController;
use App\Http\Controllers\Api\V1\CustomerOrdersController;
use App\Http\Controllers\Api\V1\CustomerUserController;
use App\Http\Controllers\Api\V1\ProductTypeController;

Route::group(['middleware' => 'api'], function () {

	Route::group(['prefix' => 'api/v1'], function () {
        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::get('/profile', [CustomerUserController::class, 'profile']);

            Route::get('/shop/{id}/banners', [BannersController::class, 'get']);
            Route::get('/shop/{id}/nomenclature', [ProductTypeController::class, 'get']);
            Route::get('/shop/{id}/orders', [CustomerOrdersController::class, 'get']);
            Route::get('shop/{id}/order/{order_id}/pdf', [CustomerOrdersController::class, 'downloadPdf']);
            Route::post('/shop/{id}/order/{order_id}/copy');
        });

        Route::post('/auth', [AuthController::class, 'sendToken']);
    });
});