<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class checkAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($rq, Closure $next)
    {
        // nếu user đã đăng nhập
        if (Auth::check())
        {
            return $next($rq);
        } else {
            return redirect('login');
        }
    }
}
