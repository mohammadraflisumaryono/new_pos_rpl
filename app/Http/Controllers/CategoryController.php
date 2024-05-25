<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
        ]);

        Category::create($request->all());

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
        dd($request->all(), $category->toArray());

        $request->validate([
            'nama' => 'required|unique:categories,nama,', $category->category_id,
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
