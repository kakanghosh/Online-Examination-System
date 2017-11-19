<?php

namespace App\Http\Middleware;

use Closure;

class loginmiddleware
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
            return $next($request);
        }

        if($request->session()->get('usertype') == 'MEMBER'){
            return redirect()->route('User.index');
        }else if($request->session()->get('usertype') == 'ADMIN'){
            return redirect()->route('Admin.index');
        }
        
    }
}
