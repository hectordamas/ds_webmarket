<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Central\{HomeController, TenantController, TenantUserController, UsersController, FormRequestController};


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
    
        Route::get('/', function () {
            return view('central.index');
        });

        Auth::routes();

        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::post('solicitudes/store', [FormRequestController::class, 'store']);

        Route::group(['middleware' => [ 'auth' ]], function(){

            Route::resource('tenants', TenantController::class);
            Route::post('/tenants/{tenant}/toggle-activo', [TenantController::class, 'toggleActivo'])->name('tenants.toggle-activo');

            Route::resource('users', UsersController::class);
            Route::post('users/toggle', [UsersController::class, 'toggleStatus']);

            Route::get('solicitudes', [FormRequestController::class, 'index']);

            Route::controller(TenantUserController::class)->group(function(){
                Route::post('tenant/users/store', 'store');
                Route::post('tenant/users/update', 'update');
                Route::post('tenant/users/destroy', 'destroy');
                Route::post('tenant/users/toggle', 'toggleStatus');

            });
            
        });    
    });
}

