<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $sliders = Slider::all();


        foreach ($products as $product) {
            $product->short_description = Str::limit($product->deskripsi, 100);
            $product->readAblePrice = 'Rp.' .  number_format($product->harga, 0, ',', '.');
        }

        $data['page_title'] = "SunnyMart";
        $data['products'] = $products;
        $data['categories'] = Category::all();
        $data['sliders'] = $sliders;

        //dd($data['categories']);

        return view('index', $data);
    }
}
