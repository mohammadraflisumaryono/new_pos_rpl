<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $data['page_title'] = "Product Management";
        return view('products.index', compact('products'), $data);
    }

    public function create()
    {
        $categories = Category::all();
        $data['page_title'] = "Create Product";
        return view('products.create', compact('categories'), $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'barcode' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'netto' => 'required|numeric',
            'dimensi' => 'required',
            'deskripsi' => 'required',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $product = new Product($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images/products', $imageName);
            $product->image = 'images/products/' . $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $data['page_title'] = "Product Detail";
        return view('products.show', compact('product'), $data);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $data['page_title'] = "Edit Product";
        return view('products.edit', compact('product', 'categories'), $data);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required',
            'barcode' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'netto' => 'required|numeric',
            'dimensi' => 'required',
            'deskripsi' => 'required',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $product->fill($request->all());

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            $image = $request->file('image');
            $imageName = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images/products', $imageName);
            $product->image = 'images/products/' . $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar saat produk dihapus
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
