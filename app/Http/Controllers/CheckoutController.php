<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function showCheckoutForm(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:carts,id',
        ]);

        $page_title = 'Checkout';
        $cartIds = $request->input('products');
        $carts = Cart::with('product')->whereIn('id', $cartIds)->get();

        $totalAmount = 0;
        $totalDiscount = 0; // Tambahkan inisialisasi total diskon

        foreach ($carts as $cart) {
            $product = $cart->product;
            $totalAmount += $cart->quantity * $product->harga;

            // Hitung diskon untuk setiap produk
            $discount = $product->getDiscount();

            // dd($discount); // Debug diskon (hapus setelah selesai debug
            if ($discount) {
                $totalDiscount += ($cart->quantity * $product->harga * $discount->discount_percentage) / 100;
            }
        }

        // Kurangi total harga dengan total diskon
        $totalAmount -= $totalDiscount;

        return view('checkout.index', compact('carts', 'totalAmount', 'totalDiscount', 'page_title'));
    }


    public function processCheckout(Request $request)
    {
        $carts = Cart::with('product')->whereIn('id', $request->products)->get();
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->harga;
        });

        // Hitung diskon berdasarkan produk yang ada di keranjang
        $totalDiscount = 0;
        foreach ($carts as $cart) {
            $product = $cart->product;
            $discount = $product->getDiscount();
            if ($discount) {
                $totalDiscount += ($cart->quantity * $cart->product->harga * $discount->discount_percentage) / 100;
            }
        }

        // Kurangi total harga dengan total diskon
        $totalAmount -= $totalDiscount;

        $serviceFee = $request->delivery_type == 'home_delivery' ? 5000 : 0;

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount + $serviceFee,
            'status' => 'pending',
            'delivery_type' => $request->delivery_type,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'service_fee' => $serviceFee,
        ]);

        foreach ($carts as $cart) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->harga,
            ]);

            $product = Product::find($cart->product_id);
            $product->stock -= $cart->quantity;
            $product->save();

            $cart->delete();
        }

        return redirect()->route('transactions.success', $transaction->id)
            ->with('success', 'Transaction success')
            ->with('totalDiscount', $totalDiscount);
    }


    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index');
    }
}
