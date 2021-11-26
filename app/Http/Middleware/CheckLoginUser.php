<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoginUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('customer')->check()) {
            if (Auth::guard('customer')->user()->emailVerify==1){
                return $next($request);
            }
        }elseif (Auth::guard('customer')->user()->emailVerify==''){
            Auth::guard('customer')->logout();
            return redirect('customer/login')->with('msg','Tài khoản chưa được kích hoạt. Vui lòng check mail.');
        }
        else {
            return redirect("customer/login");
        }
    }
}
