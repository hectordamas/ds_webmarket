<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\Api\{ProductController, CategoryController, OrderController};

use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () { 
    
    Route::prefix('v1')->group(function () {
        Route::post('productos/store', [ProductController::class, 'store']);

        Route::post('categorias/store', [CategoryController::class, 'store']);

        Route::get('orders/getCompletedOrders', [OrderController::class, 'getCompletedOrders']);
        Route::any('orders/storeSaintData', [OrderController::class, 'storeSaintData']);
    });

});
