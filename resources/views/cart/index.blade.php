@extends('template.app')

@section('page_content')
<div class="container">
    <h1>Your Shopping Cart</h1>

    @if($carts->isEmpty())
    <p>Your cart is empty.</p>
    @else


    <table class="table">
        <thead>
            <tr>
                <th>image</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)

            <tr>
                <td><img src="{{ asset('storage/'.$cart->product->image) }}" alt="{{ $cart->product->nama }}" style="width: 40px;">

                </td>
                <td>{{ $cart->product->nama }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>{{ $cart->product->readable_price }}</td>
                <td>{{ $cart->readable_total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <h3>Total:
            {{ 'Rp.' . number_format($carts->sum(function($cart) {
            return $cart->quantity * $cart->product->harga;
        }), 0, ',', '.') }}
            <button type="submit" class="btn btn-primary float-right">Beli Sekarang</button>
        </h3>
    </div>

    @endif
</div>
@endsection