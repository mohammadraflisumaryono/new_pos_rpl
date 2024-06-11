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
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->harga;
        });


        return view('checkout.index', compact('carts', 'totalAmount', 'page_title'));
    }

    public function processCheckout(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:carts,id',
            'phone_number' => 'required|string',
            'delivery_type' => 'required|in:home_delivery,store_pickup',
            'address' => 'required_if:delivery_type,home_delivery|string',
        ]);

        $carts = Cart::with('product')->whereIn('id', $request->products)->get();
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->harga;
        });
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

        return redirect()->route('transactions.show', $transaction->id)->with('success', 'Checkout successful!');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index');
    }
}
