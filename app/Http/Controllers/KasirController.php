<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Transaction;

class KasirController extends Controller
{
    //
    public function index()
    {
        return view('kasir.index');
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
