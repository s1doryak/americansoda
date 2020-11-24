<?php

/*
|--------------------------------------------------------------------------
| Api/V1 Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BannersController;
use App\Http\Controllers\Api\V1\CustomerInvoiceController;
use App\Http\Controllers\Api\V1\CustomerOrdersController;
use App\Http\Controllers\Api\V1\CustomerPreOrderController;
use App\Http\Controllers\Api\V1\CustomerShipmentsController;
use App\Http\Controllers\Api\V1\CustomerUserController;
use App\Http\Controllers\Api\V1\CustomerUseSubscribesController;
use App\Http\Controllers\Api\V1\PricingPolicyController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ProductGroupController;
use App\Http\Controllers\Api\V1\ProductTypeController;
use App\Http\Controllers\Api\V1\SettingsController;

Route::group(['middleware' => 'api'], function () {

	Route::group(['prefix' => 'api/v1'], function () {
        Route::get('/settings', [SettingsController::class, 'get'])->name('api/v1.settings');

        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::post('/customer_user_subscribe', [CustomerUseSubscribesController::class, 'create']);
            Route::get('/customer_user_subscribes', [CustomerUseSubscribesController::class, 'search']);
            Route::delete('/customer_user_subscribe/{customer_user_subscribe}', [CustomerUseSubscribesController::class, 'delete']);

            Route::get('/profile', [CustomerUserController::class, 'profile']);

            Route::group(['prefix' => '/shop/{id}'], function () {
                Route::get('/banners', [BannersController::class, 'get']);
                Route::get('/nomenclature', [ProductTypeController::class, 'nomenclature']);
                Route::get('/nomenclature/action', [ProductTypeController::class, 'nomenclatureAction']);
                Route::get('/products', [ProductController::class, 'get']);
                Route::get('/product-groups', [ProductGroupController::class, 'get']);
                Route::get('/product-types', [ProductTypeController::class, 'get']);
                Route::get('/pricing-policies', [PricingPolicyController::class, 'get']);

                Route::post('/pre-order/', [CustomerPreOrderController::class, 'create']);

                Route::get('/orders', [CustomerOrdersController::class, 'get']);
                Route::get('/orders/{order_id}/pdf', [CustomerOrdersController::class, 'downloadPdf']);

                Route::get('/documents', [CustomerShipmentsController::class, 'get']);
                Route::get('/documents/{shipment_id}/waybill/pdf', [CustomerShipmentsController::class, 'downloadWaybill']);
                Route::get('/documents/{shipment_id}/invoice/pdf', [CustomerInvoiceController::class, 'downloadInvoice']);
            });
        });

        Route::post('/auth', [AuthController::class, 'sendToken'])->name('api/v1.auth');
    });
});
