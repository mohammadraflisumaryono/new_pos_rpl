<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Dashboard Manager";
        return view('manager/index', $data);
    }
    //
}
