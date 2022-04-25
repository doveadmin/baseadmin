<?php

namespace DACore\BaseAdmin\Middleware;

use Closure;
use Illuminate\Http\Request;

class BaseAdminMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //通过session来检测用户是否登录
        //dd(config('dacore_baseadmin.baseadmin_development'));
        if (config('dacore_baseadmin.baseadmin_development')) {
            //进入下一层请求
            return $next($request);
        } else {
            if(config('dacore_baseadmin.baseadmin_homeRoute'))
                $adminHomeRoute= config('dacore_baseadmin.baseadmin_homeRoute');
            else
                $adminHomeRoute= 'admin.home';
            //跳转到首页
            return redirect()->route($adminHomeRoute);
        }
    }
}
