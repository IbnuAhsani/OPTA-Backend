<?php

namespace App\Http\Middleware;

use Closure;

class AuthMiddleware
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

        if(session("admin") !== null) return redirect()->route("admin_top_up");
        if(session("maskapai") !== null) return redirect()->route("maskapai_home");
        
        return $next($request);
    }
}
