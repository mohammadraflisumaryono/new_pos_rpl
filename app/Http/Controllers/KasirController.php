<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;


class KasirController extends Controller
{
    //
    public function index()
    {
        // Menghitung jumlah total transaksi yang belum selesai
        $totalPendingTransactions = Transaction::where('status', 'Pending')->count();

        // Menghitung jumlah total transaksi yang sedang dalam pengiriman
        $totalOnDeliveryTransactions = Transaction::where('status', 'On Delivery')->count();

        // Menghitung jumlah total transaksi yang siap untuk pengambilan
        $totalReadyTransactions = Transaction::where('status', 'Ready')->count();

        // Menghitung jumlah total transaksi yang memiliki biaya layanan
        $totalTransactionsWithServiceFee = Transaction::where('service_fee', '>', 0)->count();
        $productHampirHabis = Product::where('stock', '<=', 5)->get();
        // dd($productHampirHabis);



        // Menyiapkan data untuk ditampilkan di halaman
        $data = [
            'totalPendingTransactions' => $totalPendingTransactions,
            'totalOnDeliveryTransactions' => $totalOnDeliveryTransactions,
            'totalReadyTransactions' => $totalReadyTransactions,
            'totalTransactionsWithServiceFee' => $totalTransactionsWithServiceFee,
            'productHampirHabis' => $productHampirHabis
        ];

        // Menampilkan halaman utama kasir dengan data yang disiapkan
        return view('kasir.index', $data);
    }

    public function cekPesanan()
    {
        $transactions = Transaction::with('transactionDetails.product', 'user')
            ->whereNotIn('status', ['Completed', 'Canceled'])
            ->orderBy('created_at', 'desc')
            ->get();

        $page_title = 'Pesanan Masuk';
        return view('kasir.cekpesanan', compact('transactions', 'page_title'));
    }
}
