<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * 跳转地址
     * @var string
     */
    private $redirectTo = 'login';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                //后台规则验证则跳转至后台登录页面

                if($guard == 'backend'){
                    $this->redirectTo = 'backend/login';
                }
                return redirect()->guest($this->redirectTo);
            }
        }

        return $next($request);
    }
}
