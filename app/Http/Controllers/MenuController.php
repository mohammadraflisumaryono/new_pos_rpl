<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $data['menus'] = $menus;
        $data['page_title'] = "Menu Management";
        return view('menu.index', $data);
    }

    public function create()
    {
        $data['page_title'] = "Create Menu";
        return view('menu.create', $data);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            // Add other validation rules as needed
        ]);

        // Create a new menu
        Menu::create($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $data = [
            'page_title' => 'Edit Menu',
        ];
        return view('menu.edit', compact('menu'), $data);
    }

    public function update(Request $request, Menu $menu)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            // Add other validation rules as needed
        ]);

        // Update the menu
        $menu->update($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        // Delete the menu
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
