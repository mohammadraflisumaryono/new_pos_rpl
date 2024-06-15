<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Dashboard Super Admin";

        // Ambil data pengguna baru tiap bulan
        $currentYear = Carbon::now()->year;

        $users = User::selectRaw('COUNT(id) as count, MONTH(created_at) as month')
            ->whereYear('created_at', $currentYear)
            ->groupByRaw('MONTH(created_at)')
            ->get();

        $userCounts = array_fill(1, 12, 0); // Inisialisasi array dengan 12 nol

        foreach ($users as $user) {
            $userCounts[$user->month] = $user->count;
        }

        $data['userCounts'] = $userCounts;

        // Ambil data jumlah transaksi per bulan
        $transactions = Transaction::selectRaw('COUNT(id) as count, MONTH(created_at) as month')
            ->whereYear('created_at', $currentYear)
            ->groupByRaw('MONTH(created_at)')
            ->get();

        $transactionCounts = array_fill(1, 12, 0); // Inisialisasi array dengan 12 nol

        foreach ($transactions as $transaction) {
            $transactionCounts[$transaction->month] = $transaction->count;
        }

        $data['transactionCounts'] = $transactionCounts;

        // Ambil data jumlah uang masuk per bulan
        $revenue = Transaction::selectRaw('SUM(total_amount) as total, MONTH(created_at) as month')
            ->where('status', 'completed')
            ->whereYear('created_at', $currentYear)
            ->groupByRaw('MONTH(created_at)')
            ->get();

        // dd($revenue);

        $monthlyRevenue = array_fill(1, 12, 0.0); // Inisialisasi array dengan 12 nol

        foreach ($revenue as $month) {
            $monthlyRevenue[$month->month] = $month->total;
            // var_dump($month->total);
        }
        // die;

        $data['monthlyRevenue'] = $monthlyRevenue;
        // dd($monthlyRevenue);

        return view('superadmin.index', $data);
    }
}
