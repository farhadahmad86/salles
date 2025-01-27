<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has user->id equal to 1
        if (auth()->check() && auth()->user()->id == 1) {
            return $next($request);
        }

        // If not, return a 403 response with a custom message
        abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
    }
}
