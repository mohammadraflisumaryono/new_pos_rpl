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
        //Load Menus
        View::composer('*', function ($view) {
            // Fetch all active menus
            $menus = Menu::where('is_aktif', 'y')
                ->orderBy('menu_parent')
                ->orderBy('id')
                ->get();

            // Share the menu data with all views
            $view->with('menus', $menus);
        });
    }
}
