<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ManagerController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Dashboard Manager";

        // 1. Jumlah Transaksi per Status
        $data['transactions_status'] = Transaction::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // 2. Total Pendapatan per Bulan
        $data['monthly_revenue'] = Transaction::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('sum(total_amount) as total'))
            ->groupBy('month')
            ->get();

        // 3. Proporsi Jenis Pengiriman
        $data['delivery_type'] = Transaction::select('delivery_type', DB::raw('count(*) as count'))
            ->groupBy('delivery_type')
            ->get();

        // 4. Total Pendapatan per Hari
        $data['daily_revenue'] = Transaction::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_amount) as total'))
            ->groupBy('date')
            ->get();

        return view('manager/index', $data);
    }

    // Data Kasir
    public function datakasir()
    {
        $data['page_title'] = "Data Kasir";
        $data['kasirs'] = User::where('role', 2)->get();


        return view('manager/datakasir', $data);
    }

    public function dataUser()
    {
        $data['page_title'] = "Data Pengguna";
        $data['users'] = User::where('role', 1)->get();
        return view('manager.datauser', $data);
    }
}
