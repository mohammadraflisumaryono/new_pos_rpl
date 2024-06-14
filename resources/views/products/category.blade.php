@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->nama }}</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->nama }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->nama }}</h5>
                    <p class="card-text">{{ $product->readAblePrice }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Lihat Produk</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
