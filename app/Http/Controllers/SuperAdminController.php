<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Dashboard Super Admin";
        return view('superadmin/index', $data);
    }
}
