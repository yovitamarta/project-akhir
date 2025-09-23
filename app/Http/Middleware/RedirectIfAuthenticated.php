<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
            public function handle(Request $request, Closure $next, ...$guards): Response
        {
            foreach ($guards as $guard) {
                if (Auth::guard($guard)->check()) {
                    $user = Auth::user();
                    if ($user->role === 'admin') {
                        return redirect()->route('admindashboard');
                    }
                    return redirect()->route('dashboard');
                }
            }

            return $next($request);
        }
}
