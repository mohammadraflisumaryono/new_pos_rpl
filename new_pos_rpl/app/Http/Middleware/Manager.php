<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Manager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        if (Auth::user()->role == 4) {

            return redirect('superadmin');
        }
        if (Auth::user()->role == 3) {
            return $next($request);
        }
        if (Auth::user()->role == 2) {
            return redirect('kasir');
        }
        if (Auth::user()->role == 1) {
            return redirect('dashboard');
        }
    }
}
