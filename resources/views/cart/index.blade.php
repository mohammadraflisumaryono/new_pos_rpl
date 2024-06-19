@extends('template.app')

@section('page_content')
<div class="container">
    @if($carts->isEmpty())
    <p style="color: #FFA07A;">Keranjang belanja Anda kosong.</p>
    @else

    <form id="cartForm" action="{{ route('checkout.show') }}" method="POST">
        @csrf
        <table id="cartTable" class="table">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)

                <tr id="cart-{{ $cart->id }}">
                    <td><input type="checkbox" class="product-checkbox" name="products[]" value="{{ $cart->id }}"></td>
                    <td><img src="{{ asset('storage/'.$cart->product->image) }}" alt="{{ $cart->product->nama }}" style="width: 40px;"></td>
                    <td>{{ $cart->product->nama }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>{{ 'Rp.' . number_format($cart->product->discounted_price, 0, ',', '.') }}</td>
                    <td class="product-total">{{ 'Rp.' . number_format($cart->quantity * $cart->product->discounted_price, 0, ',', '.') }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm edit-btn" data-id="{{ $cart->id }}" data-quantity="{{ $cart->quantity }}">Ubah</button>
                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $cart->id }}">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <h3>Total: <span id="totalAmount">{{ 'Rp.' . number_format(0, 0, ',', '.') }}</span></h3>
            <button type="button" id="checkoutBtn" class="btn btn-primary float-right">Lanjut ke Pembayaran</button>
        </div>

    </form>

    <!-- Modal untuk Mengubah Kuantitas -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Ubah Kuantitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="cart_id" name="cart_id">
                        <div class="form-group">
                            <label for="quantity">Kuantitas</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutBtn = document.getElementById('checkoutBtn');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const totalAmount = document.getElementById('totalAmount');
        const editBtns = document.querySelectorAll('.edit-btn');
        const deleteBtns = document.querySelectorAll('.delete-btn');
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const quantityInput = document.getElementById('quantity');
        const cartIdInput = document.getElementById('cart_id');

        checkoutBtn.addEventListener('click', function() {
            const products = [];
            productCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    products.push(checkbox.value);
                }
            });

            if (products.length === 0) {
                alert('Silakan pilih setidaknya satu produk untuk melanjutkan ke pembayaran.');
                return;
            }

            if (confirm('Apakah Anda yakin ingin melanjutkan ke pembayaran?')) {
                document.getElementById('cartForm').submit();
            }
        });

        function calculateTotal() {
            let total = 0;
            productCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const productTotalText = row.querySelector('.product-total').textContent.replace(/[^\d,-]/g, '').replace(',', '.');
                    const productTotal = parseFloat(productTotalText);
                    total += productTotal;
                }
            });
            totalAmount.textContent = 'Rp.' + total.toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        productCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', calculateTotal);
        });

        editBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const cartId = btn.getAttribute('data-id');
                const quantity = btn.getAttribute('data-quantity');
                cartIdInput.value = cartId;
                quantityInput.value = quantity;
                editForm.action = '/cart/' + cartId + '/update';
                new bootstrap.Modal(editModal).show();
            });
        });

        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            editForm.submit();
        });

        deleteBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                const cartId = btn.getAttribute('data-id');
                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    fetch('/cart/' + cartId, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) {
                            document.getElementById('cart-' + cartId).remove();
                            calculateTotal();
                        } else {
                            console.error('Gagal menghapus item dari keranjang.');
                        }
                    }).catch(error => console.error('Terjadi kesalahan:', error));
                }
            });
        });
    });

    function closeModal() {
        const editModal = document.getElementById('editModal');
        const modal = bootstrap.Modal.getInstance(editModal);
        modal.hide();
    }
</script>
@endsection