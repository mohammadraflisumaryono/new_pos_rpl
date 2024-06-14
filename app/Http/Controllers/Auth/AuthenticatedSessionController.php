<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        

        $request->session()->regenerate();

        $userRole = Auth::user()->role;
        switch ($userRole) {
            case 1:
                # code...
                return redirect()->intended(route('dashboard', absolute: false));
                break;
            case 2:
                # code...
                return redirect()->intended(route('kasir', absolute: false));
                break;
            case 3:
                # code...
                return redirect()->intended(route('manager', absolute: false));
                break;
            case 4:
                # code...
                return redirect()->intended(route('superadmin', absolute: false));
                break;

            default:
                # code...
                return redirect()->intended(route('login', absolute: false));
                break;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
