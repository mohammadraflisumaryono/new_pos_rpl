@extends('template.app')

@section('page_content')
<div class="container">
    <h1>Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Icon (Image):</label>
            <input type="file" class="form-control" name="icon" id="icon">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection