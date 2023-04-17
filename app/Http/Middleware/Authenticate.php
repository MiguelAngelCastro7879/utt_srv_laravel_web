<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        // error_log($request->path());
        return ($request->path() == 'login-app') ? ($request->expectsJson() ? null : route('login-app-error')) : ($request->expectsJson() ? null : route('login'));
        // return $request->expectsJson() ? null : route('login-app-error');
    }
}
