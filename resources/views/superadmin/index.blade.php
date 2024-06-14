@extends('template.app')

@section('styles')
    @parent
    <style>
        .box {
            background-color: #F9DAD6;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #562D33;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .header .icon {
            color: #562D33;
            font-size: 24px;
            margin-right: 10px;
        }

        .options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 15px;
        }

        .option {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .option .icon {
            color: #562D33;
            font-size: 20px;
        }

        .option:hover {
            background-color: #f5f5f5;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .option a {
            text-decoration: none;
            color: #000000;
            margin-left: 10px;
            flex: 1;
        }

        .kasir {
            background-color: #F9DAD6;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .kasir h2 {
            color: #562D33;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .kasir .options {
            display: flex;
            flex-wrap: wrap;
        }

        .kasir .option {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            margin-right: 15px;
            margin-bottom: 15px;
            min-width: calc(33.33% - 15px);
        }

        .kasir .option .icon {
            color: #562D33;
            font-size: 20px;
        }

        .kasir .option:hover {
            background-color: #f5f5f5;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .kasir .option a {
            text-decoration: none;
            color: #000000;
            margin-left: 10px;
            flex: 1;
        }

        @media (max-width: 768px) {
            .kasir .option {
                min-width: calc(50% - 15px);
            }
        }

        /* Responsive untuk mb-4 */
        @media (min-width: 768px) {
            .mb-4 {
                margin-bottom: 1.5rem; /* sesuaikan sesuai kebutuhan */
            }
        }
    </style>
@endsection

@section('page_content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <!-- Bagian Master Data -->
                <div class="box">
                    <div class="header">
                        <span class="icon"><i class="fas fa-database"></i></span>
                        <h2>Master Data</h2>
                    </div>
                    <div class="options">
                        @foreach($menus as $menu)
                            @if($menu->menu_parent == 0 && $menu->is_aktif == 'y' && $menu->title == 'Master Data')
                                @foreach($menu->children as $child)
                                    @if($child->is_aktif == 'y')
                                        <div class="option">
                                            <span class="icon"><i class="{{ $child->icon }}"></i></span>
                                            <a href="{{ route($child->url) }}">{{ $child->title }}</a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-6">
                <!-- Bagian Layanan -->
                <div class="box">
                    <div class="header">
                        <span class="icon"><i class="fas fa-cogs"></i></span>
                        <h2>Layanan</h2>
                    </div>
                    <div class="options">
                        @foreach($menus as $menu)
                            @if($menu->menu_parent == 0 && $menu->is_aktif == 'y' && $menu->title == 'Layanan')
                                @foreach($menu->children as $child)
                                    @if($child->is_aktif == 'y')
                                        <div class="option">
                                            <span class="icon"><i class="{{ $child->icon }}"></i></span>
                                            <a href="{{ route($child->url) }}">{{ $child->title }}</a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-6">
                <!-- Bagian User -->
                <div class="box">
                    <div class="header">
                        <span class="icon"><i class="fas fa-user"></i></span>
                        <h2>User</h2>
                    </div>
                    <div class="options">
                        @foreach($menus as $menu)
                            @if($menu->menu_parent == 0 && $menu->is_aktif == 'y' && $menu->title == 'User')
                                @foreach($menu->children as $child)
                                    @if($child->is_aktif == 'y')
                                        <div class="option">
                                            <span class="icon"><i class="{{ $child->icon }}"></i></span>
                                            <a href="{{ route($child->url) }}">{{ $child->title }}</a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Bagian Kasir -->
                <div class="kasir">
                    <div class="header">
                        <span class="icon"><i class="fas fa-cash-register"></i></span>
                        <h2>Kasir</h2>
                    </div>
                    <div class="options">
                        @foreach($menus as $menu)
                            @if($menu->menu_parent == 0 && $menu->is_aktif == 'y' && $menu->title == 'Kasir')
                                @foreach($menu->children as $child)
                                    @if($child->is_aktif == 'y')
                                        <div class="option">
                                            <span class="icon"><i class="{{ $child->icon }}"></i></span>
                                            <a href="{{ route($child->url) }}">{{ $child->title }}</a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
