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
        $discounts = DiscountProduct::all();

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

        if ($query) {
            $products = Product::where('nama', 'LIKE', "%{$query}%")
                ->orWhere('deskripsi', 'LIKE', "%{$query}%")
                ->get();

            // Simpan hasil pencarian di session
            Session::flash('search_results', $products);
        } else {
            // Jika query kosong, redirect kembali ke halaman indeks
            return redirect()->route('dashboard');
        }


        // Redirect kembali ke halaman indeks
        return redirect()->route('dashboard');
    }
}
