@extends('template.app')

@section('page_content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Menu</div>

                <div class="card-body">
                    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $menu->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon:</label>
                            <input type="text" name="icon" id="icon" class="form-control" value="{{ $menu->icon }}">
                        </div>
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <input type="text" name="url" id="url" class="form-control" value="{{ $menu->url }}" required>
                        </div>
                        <div class="form-group">
                            <label for="menu_parent">Menu Parent:</label>
                            <input type="number" name="menu_parent" id="menu_parent" class="form-control" value="{{ $menu->menu_parent }}">
                        </div>
                        <div class="form-group">
                            <label for="menu_roles">Menu Roles:</label>
                            <input type="text" name="menu_roles" id="menu_roles" class="form-control" value="{{ $menu->menu_roles }}" required>
                        </div>
                        <div class="form-group">
                            <label for="is_aktif">Is Aktif:</label>
                            <select name="is_aktif" id="is_aktif" class="form-control" required>
                                <option value="y" {{ $menu->is_aktif == 'y' ? 'selected' : '' }}>Yes</option>
                                <option value="n" {{ $menu->is_aktif == 'n' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection