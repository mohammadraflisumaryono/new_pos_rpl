<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\DiscountProduct;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $carts = $user->carts()->with('product')->get();

        $discounts = DiscountProduct::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())->get();

        foreach ($carts as $cart) {
            $product = $cart->product;
            $discount = $discounts->firstWhere('product_id', $product->id);
            $total_discount = 0;
            // var_dump($discount);
            if ($discount) {

                $discounted_price = $product->harga - ($product->harga * $discount->discount_percentage / 100);
                $total_discount += $product->harga * $discount->discount_percentage / 100;
            } else {
                $discounted_price = $product->harga;
            }
            $cart->product->readable_price = 'Rp.' . number_format($cart->product->harga, 0, ',', '.');
            $cart->readable_total = 'Rp.' . number_format($cart->quantity * $cart->product->harga, 0, ',', '.');
            $cart->product->discounted_price = $discounted_price;
            $cart->product->total_discount = $total_discount;
        }
        // die;

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

        if (!$user) {
            return redirect()->route('login')->withErrors('User not authenticated');
        }

        // if (!method_exists($user, 'carts')) {
        //     dd('Method carts tidak ditemukan pada model User', $user);
        // }

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
    public function update(Request $request, Cart $cart)
    {
        // dd($request->all());
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update($request->all());
        return redirect()->route('cart.index');
    }
}
