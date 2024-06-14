@extends('template.app')

@section('page_content')
<div class="container">
    <h1>Transaction Details</h1>
    <table class="table">
        @foreach ($transactions as $transaction )
        
        @endforeach
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
        <tr>
            <th>Created At</th>
            <td>{{ $transaction->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $transaction->updated_at }}</td>
        </tr>
        
    </table>

    <h2>Products</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->transactionDetails as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->price, 2) }}</td>
                <td>{{ number_format($detail->quantity * $detail->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transactions.index') }}" class="btn btn-primary">Back to Transactions</a>
</div>
@endsection