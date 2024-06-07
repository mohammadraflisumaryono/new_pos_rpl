@extends('template.app')

@section('page_content')
<div class="container">
    <a href="{{ route('sliders.create') }}" class="btn btn-primary mb-3" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33; font-weight: bold;">Add New Categories</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
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
