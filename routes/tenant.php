<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Auth\TenantLoginController;
use App\Http\Controllers\{HomeController};

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return view('catalogo');
    });

    Route::get('/login', [TenantLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [TenantLoginController::class, 'login'])->name('tenant.login');
    Route::post('/logout', [TenantLoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [HomeController::class, 'dashboard'])->middleware('tenant.auth')->name('dashboard');;
});



