@extends('template.app')

@section('page_content')
<div class="container my-3 py-5">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
    <table id="categoriesTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Icon</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->category_id }}</td>
                <td>{{ $category->nama }}</td>
                <td>
                    @if($category->icon)
                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->nama }}" class="img-thumbnail" width="50">
                    @else
                    <img src="{{ asset('path/to/default/icon.png') }}" alt="Default Icon" class="img-thumbnail" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#categoriesTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
@endsection