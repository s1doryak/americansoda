<?php

/*
|--------------------------------------------------------------------------
| Api/V1 Routes
|--------------------------------------------------------------------------
*/


use App\Http\Controllers\Api\V1\AuthController;

Route::group(['middleware' => 'api'], function () {

	Route::group(['prefix' => 'api/v1'], function () {
        Route::group(['middleware' => 'jwt.auth'], function () {
        });

        Route::post('/auth', [AuthController::class, 'sendToken']);
    });
});