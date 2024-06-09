@extends('template.app')

@section('page_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #F9DAD6; color: #562D33;">Add New Menu</div>

                <div class="card-body" style="background-color: #FFECDB;">
                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title" style="color: #562D33;">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="icon" style="color: #562D33;">Icon:</label>
                            <input type="text" name="icon" id="icon" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="url" style="color: #562D33;">URL:</label>
                            <input type="text" name="url" id="url" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="menu_parent" style="color: #562D33;">Menu Parent:</label>
                            <input type="number" name="menu_parent" id="menu_parent" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="menu_roles" style="color: #562D33;">Menu Roles:</label>
                            <input type="text" name="menu_roles" id="menu_roles" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="is_aktif" style="color: #562D33;">Is Aktif:</label>
                            <select name="is_aktif" id="is_aktif" class="form-control" required>
                                <option value="y">Yes</option>
                                <option value="n">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #FFA07A; border-color: #FFA07A;">Add Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
