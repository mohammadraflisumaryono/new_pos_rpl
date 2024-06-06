@extends('template.app')

@section('page_content')
<div class="container">
    <h2>Checkout</h2>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                <tr>
                    <td>{{ $cart->product->nama }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>{{ $cart->product->readable_price }}</td>
                    <td>{{ $cart->readable_total }}</td>
                    <input type="hidden" name="products[]" value="{{ $cart->id }}">
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="delivery_type">Delivery Type:</label>
            <select class="form-control" id="delivery_type" name="delivery_type" required>
                <option value="home_delivery">Home Delivery</option>
                <option value="store_pickup">Store Pickup</option>
            </select>
        </div>
        <div class="form-group" id="addressDiv" style="display: none;">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address"></textarea>
        </div>
        <h3>Total: {{ 'Rp.' . number_format($totalAmount, 0, ',', '.') }}</h3>
        <button type="submit" class="btn btn-primary">Complete Purchase</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#delivery_type').change(function() {
            if ($(this).val() === 'home_delivery') {
                $('#addressDiv').show();
            } else {
                $('#addressDiv').hide();
            }
        });
    });
</script>
@endsection