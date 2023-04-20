<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class DeleteGame
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = new Roles();
        if(($request->user()->role_id == json_decode($roles->getRoles())->administrador) || $request->session()->has('codigo_eliminacion')){
            return $next($request);
        }
        Session::put('url-game', $request->id);
        return redirect('codigo/eliminar/juego');
    }
}
