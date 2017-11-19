<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class AdminTypeMiddleware
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
        if($request->session()->get('usertype') == 'ADMIN'){
            return $next($request);
        }
        
        return redirect()->route('User.index');

        
    }
}
