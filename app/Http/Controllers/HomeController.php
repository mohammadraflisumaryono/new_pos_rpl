<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        // Fetch menus based on user's role
        $menus = Menu::where(function ($query) use ($role) {
            $query->where('menu_roles', 'all')
                ->orWhere('menu_roles', 'like', '%1%')
                ->orWhere('menu_roles', 'like', '%2%')
                ->orWhere('menu_roles', 'like', '%3%')
                ->orWhere('menu_roles', 'like', '%4%');
        })->where('is_aktif', 'y')
            ->orderBy('menu_parent')
            ->orderBy('id')
            ->get();

        // dd($menus);

        $data['page_title'] = "Dashboard Super Admin";
        $data['menus'] = $menus;
        return view('index', $data);
    }

    private function hasAccess($menuRoles, $userRole)
    {
        if ($menuRoles === 'all') {
            return true;
        }

        $roleArray = explode(',', $menuRoles);
        return in_array($userRole, $roleArray) || in_array('4', $roleArray);
    }
}
