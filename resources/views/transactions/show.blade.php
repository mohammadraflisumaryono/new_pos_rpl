@extends('template.app')

@section('styles')
<style>

</style>
@endsection

@section('page_content')
<div class="container">


    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $transaction->id }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td>{{ $transaction->user->name }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>Rp. {{ number_format($transaction->total_amount) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($transaction->status) }}</td>
        </tr>
        <tr>
            <th>Delivery Type</th>
            <td>{{ str_replace('_', ' ', ucfirst($transaction->delivery_type)) }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $transaction->address ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $transaction->phone_number }}</td>
        </tr>
        <tr>
            <th>Service Fee</th>
            <td>Rp. {{ number_format($transaction->service_fee) }}</td>
        </tr>
    </table>

    <h2>Products</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discounted Price Per Unit</th> <!-- Add new column -->
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->transactionDetails as $detail)
            <tr>
                <td>{{ $detail->product->nama }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp. {{ number_format($detail->price) }}</td>
                <td>Rp. {{ isset($detail->discounted_price) ? number_format($detail->discounted_price) : '-' }}</td> <!-- Display discounted price per unit -->
                <td>Rp. {{ number_format($detail->quantity * $detail->discounted_price) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transactions.riwayattransaksi') }}" class="btn btn-primary">Riwayat Transaksi Lainnya</a>
</div>
@endsection