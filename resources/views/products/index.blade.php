@extends('template.app')

@section('page_content')
<h1>Products</h1>
<a href="{{ route('products.create') }}">Create Product</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Barcode</th>
            <th>Harga</th>
            <th>Netto</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->nama }}</td>
            <td>{{ $product->barcode }}</td>
            <td>{{ $product->harga }}</td>
            <td>{{ $product->netto }}</td>
            <td>{{ $product->category->nama }}</td>
            <td>
                <a href="{{ route('products.show', $product) }}">Show</a>
                <a href="{{ route('products.edit', $product) }}">Edit</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection