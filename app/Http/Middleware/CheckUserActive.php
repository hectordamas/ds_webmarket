<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckUserActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && !$user->activo) {
            Auth::logout();
            return redirect('login')->with('error', 'Tu cuenta está inactiva. Contacta al administrador.');
        }

        return $next($request);
    }
}
