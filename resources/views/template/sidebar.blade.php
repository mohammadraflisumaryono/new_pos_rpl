<<<<<<< Updated upstream
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{route('dashboard')}}" class="brand-link">
          <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">SunnyMart</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
              <a href="{{ route('dashboard') }}" class="brand-link">
                  @if(Auth::user())
                  <p class="brand-text font-weight-light h-2">{{ Auth::user()->name }}</p>
                  <p class="brand-text font-weight-light t h-1">
                      @switch(Auth::user()->role)
                      @case(1)
                      User
                      @break
                      @case(2)
                      Kasir< @break @case(3) Manager @break @case(4) Super Admin @break @default Guest @endswitch </p>
                          @else
                          <p class="brand-text font-weight-light h-2">Guest</p>
                          <p class="brand-text font-weight-light h-1">Guest</p>
                          @endif
              </a>
              @guest
              <a href="{{ route('login') }}" class="ml-auto">Login</a>
              @endguest
          </div>


          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  @foreach($menus as $menu)
                  @if($menu->menu_parent == 0 && $menu->is_aktif == 'y')
                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link active">
                          <i class="{{ $menu->icon }}"></i>
                          <p>
                              {{ $menu->title }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @foreach($menu->children as $child)
                          @if($child->is_aktif == 'y')
                          <li class="nav-item">
                              <a href="{{route( $child->url) }}" class="nav-link active">
                                  <i class="{{ $child->icon }}"></i>
                                  <p>{{ $child->title }}</p>
                              </a>
                          </li>
                          @endif
                          @endforeach
                      </ul>
                  </li>
                  @endif
                  @endforeach
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Simple Link
                              <span class="right badge badge-danger">New</span>
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
=======
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #F9F9F9;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link" style="background-color: #F9F9F9;">
        <img src="storage/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold" style="color: #562D33; font-size: 20px;">SunnyMart</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #F1F1F1;">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-1 mb-3 d-flex align-items-center justify-content-center" style="background-color: #F9F9F9; border-radius: 10px;">
            <div class="info text-center">
                @if(Auth::check())
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
                @endif
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline justify-content-center">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar rounded-3" type="search" placeholder="Search" aria-label="Search" style="background-color: #F9F9F9; color: #562D33;">
                <div class="input-group-append">
                    <button class="btn btn-sidebar" style="background-color: #F9F9F9;">
                        <i class="fas fa-search fa-fw" style="color: #7D6040;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($menus as $menu)
                    @if($menu->menu_parent == 0 && $menu->is_aktif == 'y')
                        <li class="nav-item menu-open" style="background-color: #F1F1F1; border-radius: 10px;">
                            <!-- Highlight specific menus -->
                            <a href="#" class="nav-link" style="color: {{ in_array($menu->title, ['Layanan', 'Master Data', 'User Management', 'User', 'Kasir']) ? '#562D33; font-weight: bold;' : '#562D33; ' }}">
                                <i class="{{ $menu->icon }}" style="color: {{ in_array($menu->title, ['Layanan', 'Master Data', 'User Management', 'User', 'Kasir']) ? '#562D33;' : '#562D33;' }}"></i>
                                <p>{{ $menu->title }}</p>
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
>>>>>>> Stashed changes
