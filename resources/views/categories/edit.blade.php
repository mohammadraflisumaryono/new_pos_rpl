@extends('template.app')

@section('page_content')
<h1>Edit Category</h1>
<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="{{ $category->nama }}" required>
    </div>
    <button type="submit">Update</button>
</form>
@endsection