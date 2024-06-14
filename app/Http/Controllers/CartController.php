<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $carts = $user->carts()->with('product')->get();

        // Menggunakan foreach untuk memberikan nilai readable_price dan readable_total untuk setiap item di keranjang
        foreach ($carts as $cart) {
            $cart->product->readable_price = 'Rp.' . number_format($cart->product->harga, 0, ',', '.');
            $cart->readable_total = 'Rp.' . number_format($cart->quantity * $cart->product->harga, 0, ',', '.');
        }

        // Mengatur judul halaman
        $page_title = 'Cart';

        return view('cart.index', compact('carts', 'page_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = auth()->user();

        // Menambahkan pengecekan apakah user sudah terautentikasi
        if (!$user) {
            return redirect()->route('login')->withErrors('User not authenticated');
        }

        // Menambahkan pengecekan apakah method carts tersedia di model User
        if (!method_exists($user, 'carts')) {
            dd('Method carts tidak ditemukan pada model User', $user);
        }

        $cart = $user->carts()->where('product_id', $request->product_id)->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity
            ]);
        } else {
            $user->carts()->create($request->all());
        }

        return redirect()->route('cart.index');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index');
    }

    public function update(Request $request, $cart_id)
    {
        // dd($request->all());
        // $cart = Cart::class;
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $cart = Cart::find($cart_id);
       $cart->update($request->all());
       return redirect()->route('cart.index');
    }
}

