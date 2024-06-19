@extends('template.app')

@section('styles')
<style>
    .centered-content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .centered-content img {
        width: 200px;
        height: auto;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('page_content')
<div class="container">

    <div class="centered-content">
        <img src="{{ asset('storage/images/qualityservice.png') }}" alt="Success">
        <p>Transaction Success</p>
    </div>

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
            <td>{{ number_format($transaction->total_amount, 2) }}</td>
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
            <td>{{ number_format($transaction->service_fee, 2) }}</td>
        </tr>
    </table>

    <h2>Products</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Price After Discount</th> <!-- Add new column -->
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->transactionDetails as $detail)
            <tr>
                <td>{{ $detail->product->nama }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->price, 2) }}</td>
                <td>{{ isset($detail->discounted_price_per_unit) ? number_format($detail->discounted_price_per_unit, 2) : '-' }}</td> <!-- Display discounted price per unit -->
                <td>{{ number_format($detail->quantity * $detail->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Shop</a>
</div>
@endsection