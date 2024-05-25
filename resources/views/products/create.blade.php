@extends('template.app')

@section('page_content')
<h1>Create Product</h1>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" name="nama" id="nama" required>
    </div>
    <div class="form-group">
        <label for="barcode">Barcode:</label>
        <input type="text" class="form-control" name="barcode" id="barcode" required>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" name="image" id="image">
    </div>
    <div class="form-group">
        <label for="harga">Harga:</label>
        <input type="number" step="0.01" class="form-control" name="harga" id="harga" required>
    </div>
    <div class="form-group">
        <label for="netto">Netto:</label>
        <input type="number" step="0.01" class="form-control" name="netto" id="netto" required>
    </div>
    <div class="form-group">
        <label for="dimensi">Dimensi:</label>
        <input type="text" class="form-control" name="dimensi" id="dimensi">
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi:</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
    </div>
    <div class="form-group">
        <label for="id">Category:</label>
        <select class="form-control" name="id" id="id" required>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nama }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection