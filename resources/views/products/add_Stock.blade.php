<!-- resources/views/products/add_stock.blade.php -->

@extends('template.app')

@section('page_content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form id="stock-form" method="POST" action="{{ route('products.updatestock') }}">
                @csrf
                <div class="form-group">
                    <label for="product_id">Pilih Produk:</label>
                    <select class="form-control" id="product_id" name="product_id">

                        <option value="">Pilih Produk</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="stock">Stok:</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan Stok">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        <div class="col-md-6">
            <div id="product-info">
                <!-- Informasi produk akan ditampilkan di sini -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi Select2 pada dropdown product_id
        $('#product_id').select2({
            placeholder: 'Pilih Produk',
            allowClear: true,
            width: '100%' // Tambahkan ini agar Select2 menyesuaikan dengan lebar form-control
        });

        // Fungsi untuk menampilkan informasi produk terpilih saat dropdown berubah
        $('#product_id').change(function() {
            var productId = $(this).val();

            if (productId) {
                fetch('{{ route("product.info") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            $('#product-info').html('<p>Produk tidak ditemukan</p>');
                        } else {
                            $('#product-info').html(`
                                <h2>Informasi Produk</h2>
                                <p><strong>Nama:</strong> ${data.nama}</p>
                                <p><strong>Gambar:</strong> <img src="${data.image}" alt="${data.name}" style="max-width: 100px;"></p>
                                <p><strong>Deskripsi:</strong> ${data.deskripsi}</p>
                                <p><strong>Stok:</strong> ${data.stock}</p>
                                <p><strong>Netto:</strong> ${data.netto}</p>
                                <p><strong>Dimensi:</strong> ${data.dimensi}</p>
                            `);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                $('#product-info').html('');
            }
        });
    });
</script>
@endsection