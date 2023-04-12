<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CodeVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // verifica si el código es válido
        if ($request->session()->has('code')) {
            return $next($request);
        }
        return redirect()->route('verify_code');
        // si el código no es válido, redirige al usuario a una página de error
    }
}
