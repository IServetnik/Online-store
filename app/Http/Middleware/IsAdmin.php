<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;

class IsAdmin
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
        if (!Auth::user()) return redirect()->route('login');
        if (!Auth::user()->is_admin) return redirect()->route('main');

        return $next($request);
    }
}
