<?php

namespace App\Http\Middleware;

use Closure, Auth;

class isUserMiddleware
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
        if(!Auth::user()->role == "USER"){
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
