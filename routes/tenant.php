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
    CartController,
    OrderController,
    UsersController,
    PaymentsController,
    FormRequestController,
    NotificationController,
    ForgotPasswordController
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

    // ForgotPasswordController
    Route::get('password/forgot', [ForgotPasswordController::class, 'showRequestForm']);
    Route::post('password/send-code', [ForgotPasswordController::class, 'sendCode']);
    
    Route::get('password/reset-code', [ForgotPasswordController::class, 'showResetForm']);
    Route::post('password/reset-code', [ForgotPasswordController::class, 'verifyCode']);

    //CartController
    Route::controller(CartController::class)->group(function(){
        Route::post('add', 'add');
        Route::post('cart/remove', 'remove');
        Route::post('cart/destroy', 'destroy');
        Route::post('enviar-pedido',  'enviarWhatsapp');
    });

    //OrderController
    Route::controller(OrderController::class)->group(function(){
        Route::post('orders/store', 'store');
        Route::get('track-order-page/{id}', 'track');
        Route::get('track-content/{id}', 'trackContent');
    });

    //Rutas con Auth
    Route::middleware('tenant.auth')->group(function () {

        // Dashboard
        Route::get('home', [HomeController::class, 'home']);

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

        Route::prefix('usuarios')->controller(UsersController::class)->group(function () {
            Route::get('/', 'index');           // Lista
            Route::get('create', 'create');    // Formulario nuevo
            Route::post('store', 'store');      // Guardar
            Route::get('{user}/edit', 'edit');   // Editar
            Route::put('{user}', 'update');    // Actualizar
            Route::delete('{user}', 'destroy'); // Eliminar
        });

        Route::controller(OrderController::class)->group(function(){
            Route::get('orders', 'index');
            Route::get('orders/ver-detalles/{id}', 'show');
            Route::post('orden-detalle', 'detalle');
            Route::post('orders/update-status', 'updateStatus');
            Route::get('orders/polling', 'polling');

        });

        Route::get('notificaciones/polling', [NotificationController::class, 'polling']);


        Route::controller(PaymentsController::class)->group(function(){
            Route::get('payments', 'index');
            Route::post('payments/store', 'store');
            Route::post('payments/toggle-active',  'toggleActive');
            Route::post('payments/destroy/{id}', 'destroy');

        });
    });
});



