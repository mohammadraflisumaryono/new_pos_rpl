<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Telescope\Telescope;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param mixed $roles
     */

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Log::info('Memulai middleware CheckSomething', ['request' => $request->all()]);

        // Jika ingin debug request
        // dd($request->all());

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $roles = is_array($roles) ? $roles : explode(',', $roles);

        if (!in_array($user->role, $roles)) {
            return redirect('/Unauthorized');
        }
        return $next($request);
    }
}
