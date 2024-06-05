<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.delivery_method' => 'required|string|in:cod,store_pickup',
            'products.*.alamat' => 'required_if:products.*.delivery_method,cod|string|max:255',
        ]);

        $user = Auth::user();
        $totalHarga = 0;

        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            $totalHarga += $productData->harga * $product['quantity'];
        }

        $transaksi = new Transaksi();
        $transaksi->user_id = $user->id;
        $transaksi->total_harga = $totalHarga;
        $transaksi->save();

        foreach ($request->products as $product) {
            $productData = Product::find($product['id']);
            $transaksiDetail = new TransaksiDetail();
            $transaksiDetail->transaksi_id = $transaksi->id;
            $transaksiDetail->product_id = $productData->id;
            $transaksiDetail->quantity = $product['quantity'];
            $transaksiDetail->harga = $productData->harga;
            $transaksiDetail->delivery_method = $product['delivery_method'];
            $transaksiDetail->alamat = $product['delivery_method'] === 'cod' ? $product['alamat'] : null;
            $transaksiDetail->save();
        }

        return response()->json(['message' => 'Transaction created successfully', 'transaksi' => $transaksi], 201);
    }
}
