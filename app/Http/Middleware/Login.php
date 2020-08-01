<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        $user=session('user');
        if(!$user){
            echo "<script>alert('请先登录');location.href='/adminLogin';</script>";
        }

        $path=$request->path();
        $route=0;
        $allRoute=['admin/index'];
        if(in_array($path,$allRoute)){
            $route=1;
        }else{
            foreach($user['perm'] as $k=>$v){
                if($v['permission_url']==$path){
                    $route=1;
                    break;
                }
            }
        }
        if(!$route){
            echo "<script>alert('没有权限');location.href='/admin/index';</script>";die;
        }

        return $next($request);
    }
}
