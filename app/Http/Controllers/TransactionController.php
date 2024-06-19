<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\DiscountProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Display a listing of transactions
    // public function index()
    // {
    //     $transactions = Transaction::with('transactionDetails.product', 'user')->get();
    //     // dd($transactions);
    //     $page_title = 'Transactions';
    //     return view('transactions.index', compact('transactions', 'page_title'));
    // }

    public function riwayattransaksi()
    {
        $transactions = Transaction::with(['transactionDetails.product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        $page_title = 'Riwayat Transaksi';
        return view('transactions.riwayattransaksi', compact('transactions', 'page_title'));
    }

    // Show the form for creating a new transaction
    // public function create()
    // {
    //     $products = Product::all();
    //     return view('transactions.create', compact('products'));
    // }

    // // Store a newly created transaction in storage
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'status' => 'required|in:pending,completed,canceled',
    //         'delivery_type' => 'required|in:home_delivery,store_pickup',
    //         'address' => 'required_if:delivery_type,home_delivery',
    //         'phone_number' => 'required_if:delivery_type,home_delivery',
    //         'products' => 'required|array',
    //         'products.*.id' => 'required|exists:products,id',
    //         'products.*.quantity' => 'required|integer|min:1',
    //     ]);

    //     $serviceFee = $request->delivery_type == 'home_delivery' ? 5000 : 0;
    //     $totalAmount = 0;

    //     // Calculate total amount
    //     foreach ($request->products as $product) {
    //         $productData = Product::find($product['id']);
    //         $totalAmount += $productData->harga * $product['quantity'];
    //     }

    //     $transaction = Transaction::create([
    //         'user_id' => $request->user_id,
    //         'total_amount' => $totalAmount + $serviceFee,
    //         'status' => $request->status,
    //         'delivery_type' => $request->delivery_type,
    //         'address' => $request->address,
    //         'phone_number' => $request->phone_number,
    //         'service_fee' => $serviceFee,
    //     ]);

    //     // Save transaction details
    //     foreach ($request->products as $product) {
    //         TransactionDetail::create([
    //             'transaction_id' => $transaction->id,
    //             'product_id' => $product['id'],
    //             'quantity' => $product['quantity'],
    //             'price' => Product::find($product['id'])->harga,
    //         ]);
    //     }

    //     return response()->json($transaction, 201);
    // }

    // Display the specified transaction
    // Display the specified transaction
    public function success($id)
    {
        $page_title = 'Transaction Detail';
        $transaction = Transaction::with('transactionDetails.product')->findOrFail($id);

        // Loop through transaction details to calculate total price and apply discount
        foreach ($transaction->transactionDetails as $detail) {
            $product = $detail->product;
            $discount = $product->getDiscount();

            // Calculate discounted price per unit
            if ($discount) {
                $detail->discounted_price_per_unit = $detail->price - ($detail->price * $discount->discount_percentage / 100);
            } else {
                $detail->discounted_price_per_unit = $detail->price;
            }
        }


        return view('transactions.success', compact('transaction', 'page_title'));
    }



    public function show($id)
    {
        $transaction = Transaction::with('transactionDetails.product')->findOrFail($id);
        $product = $transaction->transactionDetails->first()->product;

        // $transaction->created_at;
        // dd($transaction->created_at);
        $discounts = DiscountProduct::whereDate('start_date', '<=', $transaction->created_at)
            ->whereDate('end_date', '>=', $transaction->created_at)->get();

        foreach ($transaction->transactionDetails as $detail) {
            $product = $detail->product;
            $discount = $discounts->firstWhere('product_id', $product->id);

            if ($discount) {
                $detail->discounted_price = $product->harga - ($product->harga * $discount->discount_percentage / 100);
            } else {
                $detail->discounted_price = $product->harga;
            }
        }

        $page_title = 'Transaction Detail';
        return view('transactions.show', compact('transaction', 'page_title'));
    }



    // // Show the form for editing the specified transaction
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    // Update the specified transaction in storage

    // TransactionController.php

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->input('status');
        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Status updated successfully');
    }

    // TransactionController.php

    public function editStatus($id)
    {
        $transaction = Transaction::findOrFail($id);
        return response()->json($transaction);
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->status;
        $transaction->save();

        return response()->json(['success' => 'Status updated successfully']);
    }


    // // Remove the specified transaction from storage
    // public function destroy($id)
    // {
    //     $transaction = Transaction::findOrFail($id);
    //     $transaction->delete();

    //     return response()->json(null, 204);
    // }
}
