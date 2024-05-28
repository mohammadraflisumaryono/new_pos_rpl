@extends('template.app')

@section('page_content')
<h1>Create Product</h1>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" name="nama" id="nama" required>
        @error('nama')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="barcode">Barcode:</label>
        <input type="text" class="form-control" name="barcode" id="barcode" required>
        @error('barcode')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" name="image" id="image" required>
        @error('image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="harga">Harga:</label>
        <input type="number" step="0.01" class="form-control" name="harga" id="harga" required>
        @error('harga')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="netto">Netto:</label>
        <input type="number" step="0.01" class="form-control" name="netto" id="netto" required>
        @error('netto')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="dimensi">Dimensi:</label>
        <input type="text" class="form-control" name="dimensi" id="dimensi">
        @error('dimensi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi:</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
        @error('deskripsi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div id="categoryGroup">
        <div class="form-group">
            <label for="id">Category:</label>
            <select class="form-control" name="categories[]" required>

                @foreach ($categories as $category)


                <option value="{{$category->category_id }}">{{ $category->nama }} {{ $category->id }}</option>
                @endforeach
            </select>
            @error('categories')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <button type="button" class="btn btn-primary btn-sm" onclick="addCategory()">+</button>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

@section('scripts')
<script>
    function addCategory() {
        var categoryGroup = document.getElementById('categoryGroup');
        var clonedSelect = categoryGroup.querySelector('select').cloneNode(true);
        clonedSelect.selectedIndex = 0; // Reset pilihan kategori
        categoryGroup.appendChild(clonedSelect);
        var allSelects = categoryGroup.querySelectorAll('select');
        var lastSelect = allSelects[allSelects.length - 1];
        lastSelect.style.marginTop = '10px'; // Atur jarak antar category
    }
</script>
@endsection