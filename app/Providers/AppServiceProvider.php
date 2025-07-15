<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\TenantNotificationsComposer;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('tenant.layouts.admin', TenantNotificationsComposer::class);
    }
}
