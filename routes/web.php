<?php

use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
    
        Route::get('/', function () {
            return view('index');
        });

        Auth::routes();

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::group(['middleware' => [ 'auth' ]], function(){

        });    
    });
}

