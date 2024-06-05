@extends('template.app')

@section('page_content')
<h1>Products</h1>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>
<a href="{{ route('products.addstock') }}" class="btn btn-primary mb-3">Add Stock Products</a>

@if($productHampirHabis->count() > 0)
<div class="alert alert-danger">
    <h4>Produk Hampir Habis</h4>
    <ul>
        @foreach($productHampirHabis as $product)
        <li>{{ $product->nama }} (Stock: {{ $product->stock }})</li>
        @endforeach
    </ul>
</div>
@endif

<table id="productsTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Barcode</th>
            <th>Harga</th>
            <th>Stock</th>
            <th>Netto</th>
            <th>Categories</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->nama }}</td>
            <td>{{ $product->barcode }}</td>
            <td>{{ $product->readAblePrice }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->netto }}</td>
            <td>
                @foreach ($product->categories as $category)
                <span class="badge badge-info">{{ $category->nama }}</span>
                @endforeach
            </td>
            <td>
                <a href="" class="btn btn-primary btn-sm">Show</a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#productsTable').DataTable();
    });
</script>
@endsection