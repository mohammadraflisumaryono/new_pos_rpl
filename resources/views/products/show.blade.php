@extends('template.app')

@section('page_content')
<div class="card" style="width: 18rem; margin: auto;">
    @if ($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->nama }}">
    @else
    <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $product->nama }}">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $product->nama }}</h5>
        <p class="card-text"><strong>Barcode:</strong> {{ $product->barcode }}</p>
        <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($product->harga, 2) }}</p>
        <p class="card-text"><strong>Netto:</strong> {{ $product->netto }} kg</p>
        <p class="card-text"><strong>Dimensi:</strong> {{ $product->dimensi }}</p>
        <p class="card-text"><strong>Deskripsi:</strong> {{ $product->deskripsi }}</p>
        <p class="card-text"><strong>Category:</strong> {{ $product->category->nama }}</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
    </div>
</div>
@endsection