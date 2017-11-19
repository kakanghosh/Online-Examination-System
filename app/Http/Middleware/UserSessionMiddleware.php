<?php

namespace App\Http\Middleware;

use Closure;

class UserSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if (!$request->session()->has('userid')) {
            return redirect()->route('Login.loginView');
        }
        return $next($request);
    }
}
