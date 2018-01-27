<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ConductorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (  !(Auth::check() && Auth::user()->role()>2) )
        {
            return redirect('home')->withErrors('Access denied to CONDUCTOR functionality!');
        }
        return $next($request);
    }
}


