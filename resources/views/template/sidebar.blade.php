<!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="javascript:;">
          <h3 class="text-default">PERPUSTAKAAN</h3>
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">            
            @if (Session::get('type') == "admin")
            <li class="nav-item {{ Request::is('dashboardAdmin') ? 'active' : '' }}">
              <a class="nav-link {{ Request::is('dashboardAdmin') ? 'active' : '' }}" href="{{url('dashboardAdmin')}}">
                <i class="ni ni-books text-success"></i>
                <span class="nav-link-text">Master Buku</span>
              </a>
            </li>
            <li class="nav-item {{ Request::is('anggota') ? 'active' : '' }}">
              <a class="nav-link {{ Request::is('anggota') ? 'active' : '' }}" href="{{url('anggota')}}">
                <i class="ni ni-badge text-warning"></i>
                <span class="nav-link-text">Anggota</span>
              </a>
            </li>
            <li class="nav-item {{ Request::is('pinjaman') ? 'active' : '' }}">
              <a class="nav-link {{ Request::is('pinjaman') ? 'active' : '' }}" href="{{url('pinjaman')}}">
                <i class="ni ni-archive-2 text-info"></i>
                <span class="nav-link-text">Pengajuan Buku</span>
              </a>
            </li>
            @endif

            @if (Session::get('type') == "user")
            <li class="nav-item {{ Request::is('dashboardUser') ? 'active' : '' }}">
              <a class="nav-link {{ Request::is('dashboardUser') ? 'active' : '' }}" href="{{url('dashboardUser')}}">
                <i class="ni ni-collection text-success"></i>
                <span class="nav-link-text">Pinjam Buku</span>
              </a>
            </li>
            @endif
          </ul>
          <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading p-0 text-muted">Other</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="logout()">
              <i class="ni ni-user-run"></i>
              <span class="nav-link-text">Logout</span>
            </a>
          </li>
        </ul>
        </div>
      </div>
    </div>
  </nav>