@extends('template.app')

@section('page_content')
<div class="container">
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ $category->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Icon (Image):</label>
            <input type="file" class="form-control" name="icon" id="icon">
            @if($category->icon)
            <img src="{{ asset('storage/' . $category->icon) }}" alt="Icon" class="img-thumbnail mt-2" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection