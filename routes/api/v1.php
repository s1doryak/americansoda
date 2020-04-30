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
use App\Http\Controllers\Api\V1\PricingPolicyController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ProductGroupController;
use App\Http\Controllers\Api\V1\ProductTypeController;

Route::group(['middleware' => 'api'], function () {

	Route::group(['prefix' => 'api/v1'], function () {
        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::get('/profile', [CustomerUserController::class, 'profile']);

            Route::group(['prefix' => '/shop/{id}'], function () {
                Route::get('/banners', [BannersController::class, 'get']);
                Route::get('/nomenclature', [ProductTypeController::class, 'nomenclature']);
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

        Route::post('/auth', [AuthController::class, 'sendToken']);
    });
});