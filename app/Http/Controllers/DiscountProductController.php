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
        return view('discount.index', compact('discounts'));
    }

    public function create()
    {
        $products = Product::all();
        return view('discount.create', compact('products'));
    }

    public function store(Request $request)
    {
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
