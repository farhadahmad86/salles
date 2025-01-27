<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdminMiddleware
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
        if (Auth::check() && Auth::user()->role == 'Admin'){
            return $next($request);
        }
//        if (Auth::check() && Auth::user()->role == 'Admin'){
//            return $next($request);
//        }elseif (Auth::check() && Auth::user()->role == 'Supervisor'){
//            return $next($request);
//        }elseif (Auth::check() && Auth::user()->role == 'Sale Person'){
//            return $next($request);
//        }elseif (Auth::check() && Auth::user()->role == 'Product Manager'){
//            return $next($request);
//        }elseif (Auth::check() && Auth::user()->role == 'Price Manager'){
//            return $next($request);
//        }elseif (Auth::check() && Auth::user()->role == 'Tele Caller'){
//            return $next($request);
//        }
//        throw new HttpException(503);
        return redirect('/')->with('error', 'Admin access');
    }
}
