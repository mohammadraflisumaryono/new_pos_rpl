@extends('template.app')

@section('page_content')
<h1>Create Category</h1>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>
    </div>
    <button type="submit">Create</button>
</form>
@endsection