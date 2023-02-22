<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #454cb3;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}" style="background-color: #FFFFFF">
        <div class="sidebar-brand-icon">
            <img class="logo-img" src="{{url('/images/BPKP_Logo.png')}}" width="50%">
        </div>
    </a>

    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <li class="nav-item @if(request()->route()->uri == 'dashboard') active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item
    {{ Request::is('pegawai') ? 'active' : null }}
    ">
        <a class="nav-link" href="{{ route('pegawai') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Pegawai</span>
        </a>
    </li>
    @if(Auth::user()->role_id == 2)
    <li class="nav-item
    {{ Request::is('syncpeg') ? 'active' : null }}
    ">
        <a class="nav-link" href="{{ route('syncpeg') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Sync Pegawai</span>
        </a>
    </li>
    @endif
    <!-- <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-book"></i>
            <span>Keuangan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-book"></i>
            <span>Laporan</span>
        </a>
    </li> -->
</ul>
<!-- End of Sidebar -->
