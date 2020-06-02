<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use View;

class CheckAdmin
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
        if (empty(Session::get('login'))) {
            return redirect('/admin/login')->with('status', 'Session anda telah habis !');
        };

        return $next($request);
    }
}
