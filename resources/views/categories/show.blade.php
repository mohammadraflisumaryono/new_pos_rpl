@extends('template.app')

@section('page_content')
<h1>Category Details</h1>
<p>ID: {{ $category->id }}</p>
<p>Nama: {{ $category->nama }}</p>
<a href="{{ route('categories.index') }}">Back to Categories</a>
@endsection