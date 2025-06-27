<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

use App\Http\Controllers\Auth\Tenant\LoginController;
use App\Http\Controllers\Tenant\{
    HomeController, 
    CategoriesController, 
    ProductsController, 
    SettingsController, 
    ShopController, 
    OptionGroupController, 
    OptionController, 
    CartController
};

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    //ShopController
    Route::controller(ShopController::class)->group(function () {
        Route::get('/', 'index');
    });
    //Productos
    Route::controller(ProductsController::class)->group(function () {
        Route::get('products/{product}/show', 'show');
    });


    // LoginController
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'showLoginForm');
        Route::post('login', 'login')->name('tenant.login');
        Route::post('logout', 'logout')->name('logout');
    });

    //CartController
    Route::controller(CartController::class)->group(function(){
        Route::post('add', 'add');
        Route::post('cart/remove', 'remove');
        Route::post('cart/destroy', 'destroy');
    });


    //Rutas con Auth
    Route::middleware('tenant.auth')->group(function () {

        // Dashboard
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        // Categorías
        Route::controller(CategoriesController::class)->group(function () {
            Route::get('categories', 'index')->name('categories.index');
            Route::get('categories/create', 'create')->name('categories.create');
            Route::post('categories/store', 'store')->name('categories.store');
            Route::get('categories/{id}/edit', 'edit')->name('categories.edit');
            Route::post('categories/{id}/update', 'update')->name('categories.update');
            Route::post('categories/sort', 'sort')->name('categories.sort');
            Route::post('categories/{id}/destroy', 'destroy')->name('categories.destroy');
        });

        //Productos
        Route::controller(ProductsController::class)->group(function () {
            Route::get('products', 'index');
            Route::get('products/create', 'create');
            Route::post('products/store', 'store');
            Route::get('products/{id}/edit', 'edit');
            Route::post('products/{id}/update', 'update');
            Route::post('products/{id}/destroy', 'destroy');
        });

        // Grupos de opciones
        Route::resource('option-groups', OptionGroupController::Class)->only([
            'store', 'update', 'destroy'
        ])->names([
            'store' => 'tenant.option-groups.store',
            'update' => 'tenant.option-groups.update',
            'destroy' => 'tenant.option-groups.destroy'
        ]);

        // Opciones individuales
        Route::resource('options', OptionController::class)->only([
            'store', 'update', 'destroy'
        ])->names([
            'store' => 'tenant.options.store',
            'update' => 'tenant.options.update',
            'destroy' => 'tenant.options.destroy'
        ]);

        //Configuración
        Route::controller(SettingsController::class)->group(function () {
            Route::get('settings', 'index')->name('settings.index');
            Route::post('settings/update', 'update')->name('settings.update');
        });


    });
});



