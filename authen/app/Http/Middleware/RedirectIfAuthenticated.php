<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Xử lý khi tiến hành đăng nhập thành công
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin' :
                if(Auth::guard($guard)->check()){ // check nếu đăng nhâp thanh công
                    return redirect()->route('admin.dashboard');
                }
                break;
            case 'seller' :
                if(Auth::guard($guard)->check()){ // check nếu đăng nhâp thanh công
                    return redirect()->route('seller.dashboard');
                }
                break;
            case 'shipper' :
                if(Auth::guard($guard)->check()) { //check nếu đăng nhâp thanh công
                    return redirect()->route('shipper.dashboard');
                }
                break;
            default:
                if(Auth::guard($guard)-> check()){
                    return redirect()->route('home');
                }
                break;
        }
        return $next($request);
    }
}
