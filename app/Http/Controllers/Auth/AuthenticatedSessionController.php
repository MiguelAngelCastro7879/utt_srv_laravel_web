<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Roles;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $roles = new Roles();
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            if($user->role_id == json_decode($roles->getRoles())->usuario && str_contains($request->url(), env('APP_URL_WEB'))){
                $request->authenticate();
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::VERIFY_CODE);
            } 
            else if($user->role_id == json_decode($roles->getRoles())->administrador && str_contains($request->url(), env('APP_URL_VPN'))){
                $request->authenticate();
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::VERIFY_CODE);
            } 
            else if($user->role_id == json_decode($roles->getRoles())->supervisor){
                $request->authenticate();
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::VERIFY_CODE);
            } 
        }
        return redirect('login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
