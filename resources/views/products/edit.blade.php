@extends('template.app')

@section('page_content')
@section('styles')
<style>
    .categories-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        margin-bottom: 15px;
    }

    img {
        margin-top: 10px;
        width: 80px;
        height: 80px;
    }

    .category-bubble {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .category-bubble.active {
        background-color: #F9DAD6;
        border-color: #F9DAD6;
        color: #fff;
    }

    .kategori-label {
        display: block;
    }
</style>
@endsection

<h1>Edit Product</h1>
<form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" name="nama" id="nama" value="{{ $product->nama }}" required>
    </div>
    <div class="form-group">
        <label for="barcode">Barcode:</label>
        <input type="text" class="form-control" name="barcode" id="barcode" value="{{ $product->barcode }}" required>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" name="image" id="image">
        @if ($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->nama }}">
        @endif
    </div>
    <div class="form-group">
        <label for="harga">Harga:</label>
        <input type="number" step="0.01" class="form-control" name="harga" id="harga" value="{{ $product->harga }}" required>
    </div>
    <div class="form-group">
        <label for="netto">Netto:</label>
        <input type="number" step="0.01" class="form-control" name="netto" id="netto" value="{{ $product->netto }}" required>
    </div>
    <div class="form-group">
        <label for="dimensi">Dimensi:</label>
        <input type="text" class="form-control" name="dimensi" id="dimensi" value="{{ $product->dimensi }}">
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi:</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi">{{ $product->deskripsi }}</textarea>
    </div>
    <div class="categories-container">
        <label for="category ">Kategori:</label>

        @foreach ($categories as $category)
        <div class="category-bubble {{ $product->categories->contains($category->category_id) ? 'active' : '' }}" data-id="{{ $category->category_id }}">
            <span class="category-name">{{ $category->nama }}</span>
            <input type="hidden" name="categories[]" value="{{ $category->category_id }}" class="category-input" {{ $product->categories->contains($category->category_id) ? '' : 'disabled' }}>
        </div>
        @endforeach

    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.category-bubble').forEach(function(bubble) {
            bubble.addEventListener('click', function() {
                bubble.classList.toggle('active');
                var input = bubble.querySelector('.category-input');
                if (input) {
                    if (bubble.classList.contains('active')) {
                        input.removeAttribute('disabled');
                    } else {
                        input.setAttribute('disabled', 'disabled');
                    }
                }
            });
        });
    });
</script>
@endsection