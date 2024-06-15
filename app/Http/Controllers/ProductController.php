<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $productHampirHabis = Product::where('stock', '<=', 5)->get();
        foreach ($products as $product) {
            $product->readAblePrice = 'Rp.' .  number_format($product->harga, 0, ',', '.');
        }
        $page_title = "Product Management";
        return view('products.index', compact('products', 'productHampirHabis', 'page_title'));
    }

    public function create()
    {
        $categories = Category::all();
        $page_title = "Create Product";

        return view('products.create', compact('categories', 'page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'barcode' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'netto' => 'required|numeric',
            'dimensi' => 'required',
            'deskripsi' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,category_id',

        ]);

        $product = new Product($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images/products', $imageName);
            $product->image = 'images/products/' . $imageName;
        }

        $product->save();

        // Attach each selected category to the product
        $product->categories()->attach($request->categories);


        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $page_title = "Product Detail";
        return view('products.show', compact('product', 'page_title'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $page_title = "Edit Product";
        return view('products.edit', compact('product', 'categories', 'page_title'));
    }

    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'barcode' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'netto' => 'required|numeric',
            'dimensi' => 'required',
            'deskripsi' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,category_id',
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

        // Ambil kategori yang dipilih
        $selectedCategories = $request->input('categories');

        // Ambil kategori-kategori yang memiliki class 'active'
        $activeCategories = Category::whereHas('products', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        // Detach kategori yang tidak dipilih
        foreach ($activeCategories as $category) {
            if (!in_array($category->id, $selectedCategories)) {
                $product->categories()->detach($category->id);
            }
        }

        // Attach kategori yang dipilih
        $product->categories()->sync($selectedCategories);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        // Hapus gambar saat produk dihapus
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->categories()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function addStock()
    {
        dd('add stock');
        $products = Product::all();
        $page_title = "Add Stock";
        return view('products.add_stock', compact('product', 'page_title'));
    }
    // app/Http/Controllers/ProductController.php

    public function getProductInfo(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if ($product) {
            return response()->json([
                'nama' => $product->nama,
                'image' => asset('storage/' . $product->image),
                'deskripsi' => $product->deskripsi,
                'stock' => $product->stock,
                'netto' => $product->netto,
                'dimensi' => $product->dimensi,
            ]);
        }

        return response()->json(['error' => 'Product not found'], 404);
    }

    // app/Http/Controllers/ProductController.php

    public function updatestock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|numeric',
        ]);

        $product = Product::find($request->product_id);
        $product->stock += $request->stock;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Stock updated successfully.');
    }

    public function showByCategory(Category $category)
    {
        $page_h1 = false;
        $categories = Category::all();
        $sliders = Slider::all();
        $productHampirHabis = Product::where('stock', '<=', 5)->get();
        $products = $category->products;
        $page_title = "Product Management - " . $category->nama;
        $selectedCategory = $category;

        return view('index', compact('categories', 'sliders', 'products', 'page_h1', 'page_title', 'selectedCategory', 'productHampirHabis'));
    }
}
