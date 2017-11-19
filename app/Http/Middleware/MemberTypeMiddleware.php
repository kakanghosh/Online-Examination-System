<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class MemberTypeMiddleware
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
        if($request->session()->get('usertype') == 'MEMBER'){
            return $next($request);
        }
        
        return redirect()->route('Admin.index');

        
    }
}
