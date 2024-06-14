<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountProduct;
use App\Models\Product;

class DiscountProductController extends Controller
{
    public function index()
    {
        $discounts = DiscountProduct::with('product')->get();
        $page_title = 'Discount Management';
        return view('discount.index', compact('discounts', 'page_title'));
    }

    public function create()
    {
        $products = Product::all();
        $page_title = 'Create Discount';
        return view('discount.create', compact('products', 'page_title'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image_url' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        DiscountProduct::create($request->all());
        return redirect()->route('discount.index')->with('success', 'Discount created successfully.');
    }

    public function edit($id)
    {
        $discount = DiscountProduct::findOrFail($id);
        $products = Product::all();
        $page_title = 'Edit Discount';
        return view('discount.edit', compact('discount', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image_url' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $discount = DiscountProduct::findOrFail($id);
        $discount->update($request->all());
        return redirect()->route('discount.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy($id)
    {
        $discount = DiscountProduct::findOrFail($id);
        $discount->delete();
        return redirect()->route('discount.index')->with('success', 'Discount deleted successfully.');
    }
}
