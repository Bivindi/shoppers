<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!Auth::check()) {
            if ($request->route()->getPrefix() == '/admin') {
                return redirect()->route('login');
            }else{
                return redirect()->route('get:homepage');
            }
        }
//        switch ($guard) {
//            case 'admin':
//                if (!Auth::guard($guard)->check()) {
//                    return redirect()->route('login');
//                }
//                break;
//            default:
//                if (!Auth::guard($guard)->check()) {
//                    return redirect()->route('get:homepage');
//                }
//                break;
//        }
        return $next($request);
    }
}
