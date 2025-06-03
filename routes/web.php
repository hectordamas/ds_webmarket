<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, TenantController};

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
    
        Route::get('/', function () {
            return view('index');
        });

        Auth::routes();

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::group(['middleware' => [ 'auth' ]], function(){
             Route::resource('tenants', TenantController::class);
        });    
    });
}

