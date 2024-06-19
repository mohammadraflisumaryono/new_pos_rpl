<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\DiscountProduct;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index()
    {

        $products = Product::all();
        $sliders = Slider::all();
        $categories = Category::all();
        $discounts = DiscountProduct::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())->get();

        // dd($discounts);



        // $page_title = "Blank";

        // Loop melalui produk untuk menambahkan informasi diskon
        foreach ($products as $product) {
            // Logika untuk menentukan apakah produk memiliki diskon
            // Misalnya, jika id produk ada dalam array id produk yang memiliki diskon
            $product->discounted_price = $product->harga; // Harga diskon awal, jika tidak ada diskon

            foreach ($discounts as $discount) {
                if ($discount->product_id === $product->id) {
                    // Harga diskon baru
                    $product->discounted_price = $product->harga * ((100 - $discount->discount_percentage) / 100);
                    break; // Keluar dari loop jika sudah ditemukan diskon untuk produk ini
                }
            }

            $product->short_description = Str::limit($product->deskripsi, 100);
            $product->readAblePrice = 'Rp.' .  number_format($product->harga, 0, ',', '.');
        }

        // Kirim data produk, slider, dan diskon ke view
        return view('index', compact('products', 'sliders', 'discounts', 'categories'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $page_title = "Result for: $query";


        if ($query) {
            $products = Product::where(function ($q) use ($query) {
                $q->where('nama', 'LIKE', "%{$query}%")
                    ->orWhere('barcode', 'LIKE', "%{$query}%")
                    ->orWhere('harga', 'LIKE', "%{$query}%")
                    ->orWhere('stock', 'LIKE', "%{$query}%")
                    ->orWhere('netto', 'LIKE', "%{$query}%")
                    ->orWhere('dimensi', 'LIKE', "%{$query}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$query}%");
            })->get();
            // dd($products);

            // Loop melalui produk untuk menambahkan informasi diskon
            foreach ($products as $product) {
                $product->discounted_price = $product->harga; // Harga diskon awal, jika tidak ada diskon
                $product->short_description = Str::limit($product->deskripsi, 100);
                $product->readAblePrice = 'Rp.' .  number_format($product->harga, 0, ',', '.');
            }

            // Kirim data produk ke view
            return view('searchpage', compact('products', 'page_title'));
        } else {
            // Jika query kosong, redirect kembali ke halaman indeks

            return redirect()->route('dashboard')
                ->with('message', 'Produk tidak ditemukan');
        }


        // Redirect kembali ke halaman indeks
        return redirect()->route('dashboard');
    }
}
