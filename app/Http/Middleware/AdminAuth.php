<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    protected Guard $auth;

    function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next): mixed
    {
        if ($this->auth->guest()) {
            Auth::logout();

            return redirect()->route('login')->with('error', trans('messages.auth.accessDenied'));
        }

        return $next($request);
    }
}
