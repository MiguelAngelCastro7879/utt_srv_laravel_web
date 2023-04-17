<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QrVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = new Roles();
        if($request->user()->role_id == json_decode($roles->getRoles())->administrador){
            if ($request->session()->has('qr_code')) {
                return $next($request);
            }
            return redirect()->route('qr_code');
        }
        return $next($request);
    }
}
