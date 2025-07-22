<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\Api\{ProductController, CategoryController};

use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () { 
    Route::prefix('v1')->group(function () {
        Route::get('productos', [ProductController::class, 'index']);
        Route::post('productos/store', [ProductController::class, 'store']);

        Route::post('categorias/store', [CategoryController::class, 'store']);
    });

});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

