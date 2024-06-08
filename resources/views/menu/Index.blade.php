@extends('template.app')

@section('page_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background-color: #FFCCCB; color: #562D33;">Menu List</div>

                <div class="card-body" style="background-color: #FFECDB;">
                    <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33" >Add New Menu</a>

                    @if(session('success')) 
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>URL</th>
                                <th>Menu Parent</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->title }}</td>
                                <td>{{ $menu->icon }}</td>
                                <td>{{ $menu->url }}</td>
                                <td>{{ $menu->menu_parent }}</td>
                                <td>
                                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-danger" style="background-color: #FFCCCB; border-color: #FFCCCB; color: #562D33" >Edit</a>
                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display: inline-block;">
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
            </div>
        </div>
    </div>
</div>
@endsection
