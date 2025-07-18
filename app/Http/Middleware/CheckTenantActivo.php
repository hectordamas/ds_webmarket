<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenantActivo
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = tenant(); // Stancl\Tenancy helper

        if (!$tenant || !$tenant->activo) {
            // Puedes devolver una vista bonita, o un abort
            return response()->view('errors.tenant_inactivo', [], 403);
        }

        return $next($request);
    }
}
