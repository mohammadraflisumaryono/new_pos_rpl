<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        dd($request->all());
        $cartIds = $request->input('products');
        $totalAmount = 0;

        if (empty($cartIds)) {
            return redirect()->back()->with('error', 'No products selected for checkout.');
        }

        $carts = Cart::whereIn('id', $cartIds)->get();

        foreach ($carts as $cart) {
            $totalAmount += $cart->quantity * $cart->product->harga;
        }

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'pending'
        ]);

        foreach ($carts as $cart) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->harga,
                'total' => $cart->quantity * $cart->product->harga,
            ]);

            $product = Product::find($cart->product_id);
            $product->stock -= $cart->quantity;
            $product->save();

            $cart->delete();
        }

        return redirect()->route('transactions.show', $transaction->id)->with('success', 'Checkout successful!');
    }

    public function showCheckoutForm(Request $request)
    {
        $cartIds = $request->input('products');
        $carts = Cart::with('product')->whereIn('id', $cartIds)->get();
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->harga;
        });

        return view('checkout.index', compact('carts', 'totalAmount'));
    }

    public function processCheckout(Request $request)
    {
        dd($request->all());
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:carts,id',
            'phone_number' => 'required|string',
            'delivery_type' => 'required|in:home_delivery,store_pickup',
            'address' => 'required_if:delivery_type,home_delivery|string',
        ]);

        // Proses checkout, buat transaksi, dll.

        return redirect()->route('transactions.index')->with('success', 'Transaction completed successfully!');
    }
}
