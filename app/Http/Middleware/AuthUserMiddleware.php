<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class AuthUserMiddleware
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
        if(Auth::check() && Auth::user()->isAdmin != 1) {
            return Redirect::to('crm/create');
        }
        return $next($request);
    }
}