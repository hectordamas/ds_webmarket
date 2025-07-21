<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;

class InitializeTenant
{
    public function handle(Request $request, Closure $next)
    {
        $subdomain = explode('.', $request->getHost())[0];

        // Aquí asumimos que el subdominio es el tenant_id (puede ser UUID)
        $tenant = Tenant::where('id', $subdomain)->first();

        if (! $tenant) {
            return response()->view('errors.tenant_not_found', [], 404);
        }

        // Activar el tenant (si usas stancl/tenancy)
        tenancy()->initialize($tenant);

        return $next($request);
    }
}
