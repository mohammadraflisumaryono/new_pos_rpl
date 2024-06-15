@extends('template.app')

@section('page_content')
<div class="container my-3 py-5">
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3" style="background-color: #F9DAD6; border-color: #F9DAD6; color: #562D33; font-weight: bold;">Create Category</a>
    <table id="categoriesTable" class="table table-striped table-bordered" style="background-color: #FFECDB;">
        <thead>
            <tr>
                <th style="color: #562D33;">ID</th>
                <th style="color: #562D33;">Nama</th>
                <th style="color: #562D33;">Icon</th>
                <th style="color: #562D33;">Actions</th>
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
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-danger" style="background-color: #F9DAD6; border-color: #F9DAD6; color: #562D33" >Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
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
