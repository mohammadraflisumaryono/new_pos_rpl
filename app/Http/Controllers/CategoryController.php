<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $page_title = 'Category Management';
        return view('categories.index', compact('categories', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Create Category';
        return view('categories.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:categories',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category;
        $category->nama = $request->nama;

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('images/categories', 'public');
            $category->icon = $iconPath;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }


    public function show(Category $category)
    {
        $page_title = 'Category Detail';
        return view('categories.show', compact('category', 'page_title'));
    }

    public function edit(Category $category)
    {
        $page_title = 'Edit Category';
        return view('categories.edit', compact('category', 'page_title'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama' => 'required|unique:categories,nama,' . $category->id,
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }
            $data['icon'] = $request->file('icon')->store('images/categories', 'public');
        } else {
            unset($data['icon']);
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->icon) {
            Storage::disk('public')->delete($category->icon);
        }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
