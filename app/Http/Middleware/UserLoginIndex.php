<?php

namespace App\Http\Middleware;

use Closure;

class UserLoginIndex
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
        if(!session('user')){
            echo "<script>alert('请先登录');location.href='/login';</script>";
            die;
        }
        return $next($request);
    }
}
