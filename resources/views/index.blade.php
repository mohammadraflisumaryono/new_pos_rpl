@extends('template.app')
@section('styles')
@parent
<style>
    .box {
        background-color: #AAD7D9;
        border: 1px solid #ccc;
        padding: 20px;
        width: 1000px;
        /* Sesuaikan dengan lebar yang diinginkan */
        margin-bottom: 20px;
        border-radius: 20px 20px;
    }

    h2 {
        color: #effafc;
        margin: 5px;
        margin-bottom: 10px;
    }

    .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .header .icon {
        color: #d3ea7b;
        margin-right: 10px;

        padding-bottom: 32px;
    }

    .options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 20px;
    }

    .option {
        text-decoration: none;
        color: #000000;
        display: flex;
        align-items: center;
        padding: 5px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        cursor: pointer;
    }

    .option .icon {
        color: #197f9a;
        margin-right: 5px;
        padding-bottom: 40px;
        font-size: 23px;
        /* Sesuaikan dengan ukuran yang diinginkan */
    }

    .option p {
        margin: 0;
    }

    .option a {
        text-decoration: none;
        color: #000000;
        border: none;
        padding: 5px;
        display: block;
        margin-left: 10px;
        width: calc(100% - 20px);
    }

    .option:hover {
        background-color: #f5f5f5;
        /* Add hover effect */
    }

    .row {
        margin-bottom: 25px
    }

    .rowdashboard {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
</style>
@endsection

@section('page_title_actions')
@endsection


@section('page_content')
<div class="row rowdashboard">
    @foreach($menus as $menu)
    @if($menu->menu_parent == 0 && $menu->is_aktif == 'y')
    <div class="box">
        <div class="header">
            <span class="icon"><i class="{{ $menu->icon }}"></i></span>
            <h2>{{ $menu->title }}</h2>
        </div>

        <div class="options">
            @foreach($menu->children as $child)
            @if($child->is_aktif == 'y')
            <div class="option">
                <span class="icon ms-2"><i class="{{ $child->icon }}"></i></span>

                <a href="{{ $child->url }}">{{ $child->title }}</a>
            </div>

            <!-- Tambahkan opsi lainnya di sini dengan format yang sama -->
            @endif
            @endforeach
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection