@extends('template.app')

@section('page_content')
<div class="container">
    @if($carts->isEmpty())
        <p style="color: #FFA07A;">Your cart is empty.</p>
    @else

    <form id="cartForm" action="{{ route('checkout') }}" method="POST">
        @csrf
        <table id="cartTable" class="table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                <tr>
                    <td><input type="checkbox" class="product-checkbox" name="products[]" value="{{ $cart->id }}"></td>
                    <td><img src="{{ asset('storage/'.$cart->product->image) }}" alt="{{ $cart->product->nama }}" style="width: 40px;"></td>
                    <td>{{ $cart->product->nama }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>{{ 'Rp.' . number_format($cart->product->harga, 0, ',', '.') }}</td>
                    <td class="product-total">{{ 'Rp.' . number_format($cart->quantity * $cart->product->harga, 0, ',', '.') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33; data-id="{{ $cart->id }}" data-quantity="{{ $cart->quantity }}">Edit</button>
                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <h3>Total: <span id="totalAmount">{{ 'Rp.' . number_format(0, 0, ',', '.') }}</span></h3>
            <button type="submit" id="checkoutBtn" class="btn btn-sm float-right" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33; font-weight: bold">Proceed to Checkout</button>
            </div>>Proceed to Checkout</button>
        </div>

    </form>

    @endif
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#checkoutBtn').click(function() {
            var products = [];
            $('.product-checkbox:checked').each(function() {
                products.push($(this).val());
            });

            if (products.length === 0) {
                alert('Please select at least one product to checkout.');
                return;
            }

            if (confirm('Are you sure you want to proceed to checkout?')) {
                $.ajax({
                    url: '{{ route("checkout") }}',
                    type: 'POST', // Change to POST
                    data: {
                        _token: '{{ csrf_token() }}',
                        products: products
                    },
                    success: function(response) {
                        // Redirect or show success message
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        $('#cartTable').DataTable();

        function calculateTotal() {
            var total = 0;
            $('.product-checkbox:checked').each(function() {
                var row = $(this).closest('tr');
                var productTotalText = row.find('.product-total').text().replace(/[^\d,-]/g, '').replace(',', '.');
                var productTotal = parseFloat(productTotalText);
                total += productTotal;
            });
            $('#totalAmount').text('Rp.' + total.toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }));
        }

        $('.product-checkbox').change(function() {
            calculateTotal();
        });

        $('.edit-btn').click(function() {
            var cartId = $(this).data('id');
            var quantity = $(this).data('quantity');
            $('#cart_id').val(cartId);
            $('#quantity').val(quantity);
            $('#editModal').modal('show');
        });

        $('#editForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var cartId = $('#cart_id').val();
            $.ajax({
                url: '/cart/' + cartId,
                type: 'POST',
                data: formData,
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
