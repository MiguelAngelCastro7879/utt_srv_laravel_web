<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificationDestroyCodes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = new Roles();
        if(!($request->user()->role_id == json_decode($roles->getRoles())->usuario) && str_contains($request->url(), env('APP_URL_VPN'))){
            return response()->json(['error' => 'No autorizado'], 400);
        }
        return $next($request);
    }
}
