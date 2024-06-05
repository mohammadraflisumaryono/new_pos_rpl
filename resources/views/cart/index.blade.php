@extends('template.app')

@section('page_content')
<div class="container">

    @if($carts->isEmpty())
    <p>Your cart is empty.</p>
    @else

    <table id="cartTable" class="table">
        <thead>
            <tr>
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
                <td><img src="{{ asset('storage/'.$cart->product->image) }}" alt="{{ $cart->product->nama }}" style="width: 40px;"></td>
                <td>{{ $cart->product->nama }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>{{ $cart->product->readable_price }}</td>
                <td>{{ $cart->readable_total }}</td>
                <td>
                    <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $cart->id }}" data-quantity="{{ $cart->quantity }}">Edit</button>
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
        <h3>Total: {{ 'Rp.' . number_format($carts->sum(function($cart) {
            return $cart->quantity * $cart->product->harga;
        }), 0, ',', '.') }}</h3>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#editModal">Beli Sekarang</button>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Quantity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="cart_id" id="cart_id">
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endif
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('#cartTable').DataTable();

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