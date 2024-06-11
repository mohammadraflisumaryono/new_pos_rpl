<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Display a listing of transactions
    public function index()
    {
        $transactions = Transaction::with('user')->get();
        return view('transactions.index', compact('transactions'));
    }

    // Show the form for creating a new transaction
    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    // Store a newly created transaction in storage
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,completed,canceled',
            'delivery_type' => 'required|in:home_delivery,store_pickup',
            'address' => 'required_if:delivery_type,home_delivery',
            'phone_number' => 'required_if:delivery_type,home_delivery',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $serviceFee = $request->delivery_type == 'home_delivery' ? 5000 : 0;
        $totalAmount = 0;

        // Calculate total amount
        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            $totalAmount += $productData->harga * $product['quantity'];
        }

        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'total_amount' => $totalAmount + $serviceFee,
            'status' => $request->status,
            'delivery_type' => $request->delivery_type,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'service_fee' => $serviceFee,
        ]);

        // Save transaction details
        foreach ($request->products as $product) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => Product::find($product['id'])->harga,
            ]);
        }

        return response()->json($transaction, 201);
    }

    // Display the specified transaction
    public function show($id)
    {
        $transaction = Transaction::with('transactionDetails.product')->findOrFail($id);
        return response()->json($transaction);
    }

    // Show the form for editing the specified transaction
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    // Update the specified transaction in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,canceled',
            'delivery_type' => 'required|in:home_delivery,store_pickup',
            'address' => 'required_if:delivery_type,home_delivery',
            'phone_number' => 'required_if:delivery_type,home_delivery',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $transaction = Transaction::findOrFail($id);
        $serviceFee = $request->delivery_type == 'home_delivery' ? 5000 : 0;
        $totalAmount = 0;

        // Calculate total amount
        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            $totalAmount += $productData->harga * $product['quantity'];
        }

        $transaction->update([
            'status' => $request->status,
            'delivery_type' => $request->delivery_type,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'total_amount' => $totalAmount + $serviceFee,
            'service_fee' => $serviceFee,
        ]);

        // Delete existing transaction details
        $transaction->transactionDetails()->delete();

        // Save new transaction details
        foreach ($request->products as $product) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => Product::find($product['id'])->harga,
            ]);
        }

        return response()->json($transaction, 200);
    }

    // Remove the specified transaction from storage
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(null, 204);
    }
}
