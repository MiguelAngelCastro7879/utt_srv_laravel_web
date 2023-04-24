<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Roles;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        try {
            $roles = new Roles();
            $user = User::where('email', $request->input('email'))->first();
            if($user){
                if($user->role_id == json_decode($roles->getRoles())->usuario && str_contains($request->url(), env('APP_URL_WEB'))){
                    $request->authenticate();
                    $request->session()->regenerate();
                    return redirect()->intended(RouteServiceProvider::HOME);
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
            return abort(419, 'El usuario no existe');
        } catch (\Throwable $th) {
            return abort(403, 'La sesion ha caducado');
        }
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
    
    public function login_app(Request $request)
    {
        
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        
        return response()->json([
            'access_token' => $tokenResult->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }
}
