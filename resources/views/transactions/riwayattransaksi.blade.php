@extends('template.app')

@section('page_content')
@if($transactions->count() > 0)
<div class="container">
    <h1>{{ $page_title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal Transaksi</th>
                <th>Jumlah Transaksi</th>
                <th>Status Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ $transaction->total_amount }}</td>
                <td>{{ $transaction->status }}</td>
                <td>
                    <a href="{{ route('transactions.show', ['transaction' => $transaction->id]) }}" class="btn btn-primary" data-toggle="modal" data-target="#transactionModal" data-id="{{ $transaction->id }}">Lihat Selengkapnya</a>
                </td>
                @endforeach
        </tbody>
    </table>
</div>
@else
<p style="color: #FFA07A;">Belum ada transaksi yang dilakukan.</p>
@endif



@endsection