<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('details.product')->get();
        $data['transaksis'] = $transaksis;
        $data['page_title'] = 'Transaksi';
        return view('transaksis.index', compact('transaksis'));
    }

    public function create()
    {
        return view('transaksis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.harga' => 'required|numeric',
            'details.*.delivery_method' => 'required|in:pickup,delivery',
            'details.*.alamat' => 'nullable|required_if:details.*.delivery_method,delivery',
        ]);

        $totalHarga = 0;
        foreach ($request->details as $detail) {
            $totalHarga += $detail['quantity'] * $detail['harga'];
            if ($detail['delivery_method'] === 'delivery') {
                $totalHarga += 10000;
            }
        }

        $transaksi = Transaksi::create([
            'user_id' => $request->user_id,
            'total_harga' => $totalHarga,
        ]);

        foreach ($request->details as $detail) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'harga' => $detail['harga'],
                'delivery_method' => $detail['delivery_method'],
                'alamat' => $detail['delivery_method'] === 'delivery' ? $detail['alamat'] : null,
                'service_fee' => $detail['delivery_method'] === 'delivery' ? 10000 : 0,
            ]);
        }

        return redirect()->route('transaksis.index')->with('success', 'Transaksi created successfully.');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('details.product')->findOrFail($id);
        return view('transaksis.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('details.product')->findOrFail($id);
        return view('transaksis.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.harga' => 'required|numeric',
            'details.*.delivery_method' => 'required|in:pickup,delivery',
            'details.*.alamat' => 'nullable|required_if:details.*.delivery_method,delivery',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['user_id' => $request->user_id]);

        $transaksi->details()->delete();

        $totalHarga = 0;
        foreach ($request->details as $detail) {
            $totalHarga += $detail['quantity'] * $detail['harga'];
            if ($detail['delivery_method'] === 'delivery') {
                $totalHarga += 10000;
            }
        }

        $transaksi->update(['total_harga' => $totalHarga]);

        foreach ($request->details as $detail) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'harga' => $detail['harga'],
                'delivery_method' => $detail['delivery_method'],
                'alamat' => $detail['delivery_method'] === 'delivery' ? $detail['alamat'] : null,
                'service_fee' => $detail['delivery_method'] === 'delivery' ? 10000 : 0,
            ]);
        }

        return redirect()->route('transaksis.index')->with('success', 'Transaksi updated successfully.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksis.index')->with('success', 'Transaksi deleted successfully.');
    }
}
