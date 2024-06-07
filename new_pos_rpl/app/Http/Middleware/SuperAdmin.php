<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('login'); // Redirect to login if not authenticated
        }

        // Redirect based on user role
        switch (Auth::user()->role) {
            case 4:
                return $next($request); // Allow superadmin to proceed
            case 3:
                return redirect('manager'); // Redirect managers
            case 2:
                return redirect('kasir'); // Redirect cashiers
            case 1:
                return redirect('dashboard'); // Redirect regular users
            default:
                return redirect('login'); // Default redirect for undefined roles
        }
    }
}
