<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load Menus
        View::composer('*', function ($view) {
            // Fetch all active menus
            $menus = Menu::where('is_aktif', 'y')
                ->orderBy('menu_parent')
                ->orderBy('id')
                ->get();

            $user = Auth::user();

            // dd($menus);
            // Filter menus based on user role
            if ($user) {
                $userRole = $user->role;

                $menus = $menus->filter(function ($menu) use ($userRole) {
                    $menuRoles = explode(',', $menu->menu_roles);
                    // dd($menuRoles);
                    return in_array('all', $menuRoles) || in_array($userRole, $menuRoles);
                });
            } else {
                // If user is not authenticated, only show menus accessible to 'all'
                $menus = $menus->filter(function ($menu) {
                    $menuRoles = explode(',', $menu->menu_roles);
                    return in_array('guest', $menuRoles);
                });
            }

            // Share the menu data with all views
            $view->with('menus', $menus);
        });
    }
}
