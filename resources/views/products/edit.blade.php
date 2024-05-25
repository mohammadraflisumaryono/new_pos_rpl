@extends('template.app')

@section('page_content')


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
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama }}" style="width: 150px;">
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
    <div class="form-group">
        <label for="id">Category:</label>
        <select class="form-control" name="id" id="id" required>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if($product->id == $category->id) selected @endif>{{ $category->nama }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection