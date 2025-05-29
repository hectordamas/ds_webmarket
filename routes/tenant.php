<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Auth\TenantLoginController;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return view('catalogo');
    });

    Route::get('/login', [TenantLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [TenantLoginController::class, 'login']);
    Route::post('/logout', [TenantLoginController::class, 'logout'])->name('logout');
 
});



