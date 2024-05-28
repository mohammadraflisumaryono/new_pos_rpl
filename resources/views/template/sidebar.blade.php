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
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="">
                  <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" class="brand-image img-circle elevation-3" style=" width: 40px; height: 40px; margin:auto; padding:auto;">
              </div>
              <div class="info">
                  <a href="#" class="d-block">Alexander Pierce</a>
              </div>
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