<!-- Main Sidebar Container -->
<aside id="main-sidebar" class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #FFFFFF; ">
    <!-- Brand Logo -->
<<<<<<< HEAD
    <a href="{{ route('dashboard') }}" class="brand-link" style="background-color: #F9DAD6;">
        <img src="storage/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold" style="color: #562D33; font-size: 20px;">SunnyMart</span>
=======
    <a href="{{ route('dashboard') }}" class="brand-link" style="background-color: #F9DAD6; display: flex; align-items: center;">
    <img src="{{ asset('storage/images/logo.png') }}" alt="SunnyMart Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold" style="color: #562D33; font-size: 20px; text-decoration: none;">SunnyMart</span>
>>>>>>> 0a431c9260647caf551386779d155ad19e962315
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #FFFFFF;">
        <div class="user-panel align-items-center justify-content-center text-center user-info" style="background-color: #F9DAD6; border-radius: 10px; padding: 10px 5px; margin: 10px auto; width: auto; max-width: 90%;">
            <div class="info text-center">
                @if(Auth::check())
<<<<<<< HEAD
                    <a href="#" class="d-block" style="color: #562D33; font-size: 18px; font-weight:bold">{{ Auth::user()->name }}</a>
                    <p style="color: #7D6040; font-size: 16px;">
                        @switch(Auth::user()->role)
                            @case(1)
                                User
                                @break
                            @case(2)
                                Kasir
                                @break
                            @case(3)
                                Manager
                                @break
                            @case(4)
                                Super Admin
                                @break
                            @default
                                Guest
                        @endswitch
                    </p>
                @else
                    <a href="#" class="d-block" style="color: #7D6040; font-size: 18px;">Guest</a>
                    <p style="color: #7D6040; font-size: 16px;">Guest</p>
=======
                <a href="#" class="d-block" style="color: #562D33; font-size: 18px; font-weight: bold; ">{{ Auth::user()->name }}</a>
                <p style="color: #562D33; font-size: 16px;">
                    @switch(Auth::user()->role)
                    @case(1)
                    User
                    @break

                    @case(2)
                    Kasir
                    @break

                    @case(3)
                    Manager
                    @break

                    @case(4)
                    Super Admin
                    @break

                    @endswitch


                </p>
                @else
                <a href="#" class="d-block" style="color: #562D33; font-size: 18px; text-align: center;">Guest</a>
                <p style="color: #562D33; font-size: 16px; text-align: center;">Guest</p>
>>>>>>> 0a431c9260647caf551386779d155ad19e962315
                @endif
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline justify-content-center search-form" style="display: none;">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="background-color: #FFFFFF; color: #562D33; border-radius: 30px; padding: 5px 10px;">
                <div class="input-group-append">
                    <button class="btn btn-sidebar" type="submit" style="background-color: #F9DAD6; border-radius: 30px; padding: 5px 10px;">
                        <i class="fas fa-search fa-fw" style="color: #562D33;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($menus as $menu)
<<<<<<< HEAD
                    @if($menu->menu_parent == 0 && $menu->is_aktif == 'y')
                        <li class="nav-item menu-open" style="background-color: #ffcccb; border-radius: 10px;">
                            <!-- Highlight specific menus -->
                            <a href="#" class="nav-link" style="color: {{ in_array($menu->title, ['Layanan', 'Master Data', 'User Management', 'User', 'Kasir']) ? '#562D33; font-weight: bold;' : '#562D33; ' }}">
                                <i class="{{ $menu->icon }}" style="color: {{ in_array($menu->title, ['Layanan', 'Master Data', 'User Management', 'User', 'Kasir']) ? '#562D33;' : '#562D33;' }}"></i>
                                <p>{{ $menu->title }}</p>
=======
                @if($menu->menu_parent == 0 && $menu->is_aktif == 'y')
                <li class="nav-item menu-open" style="background-color: #FFFFFF; border-radius: 10px;">
                    <!-- Highlight specific menus -->
                    <a href="#" class="nav-link" style="color: {{ in_array($menu->title, ['Layanan', 'Master Data', 'User Management', 'User', 'Kasir']) ? '#562D33; font-weight: bold;' : '#562D33;' }}">
                        <i class="{{ $menu->icon }}" style="color: {{ in_array($menu->title, ['Layanan', 'Master Data', 'User Management', 'User', 'Kasir']) ? '#562D33;' : '#562D33;' }}"></i>
                        <p>{{ $menu->title }}</p>
                    </a>
                    @if(!empty($menu->children))
                    <ul class="nav nav-treeview">
                        @foreach($menu->children as $child)
                        @if($child->is_aktif == 'y')
                        <li class="nav-item">
                            <a href="{{ route($child->url) }}" class="nav-link" style="color: #562D33;">
                                <i class="{{ $child->icon }}"></i>
                                <p>{{ $child->title }}</p>
>>>>>>> 0a431c9260647caf551386779d155ad19e962315
                            </a>
                            @if(!empty($menu->children))
                                <ul class="nav nav-treeview">
                                    @foreach($menu->children as $child)
                                        @if($child->is_aktif == 'y')
                                            <li class="nav-item">
                                                <a href="{{ route($child->url) }}" class="nav-link" style="color: #562D33;">
                                                    <i class="far fa-circle nav-icon" style="color: #562D33;"></i>
                                                    <p>{{ $child->title }}</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>