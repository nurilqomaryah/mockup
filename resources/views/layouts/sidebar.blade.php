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
            <i class="fa-solid fa-house"></i>
            <span style="font-size: medium;">Dashboard</span>
        </a>
    </li>
    <li class="nav-item
    {{ Request::is('keuangan') ? 'active' : null }}
    ">
        <a class="nav-link" href="{{ route('keuangan') }}">
            <i class="fa-solid fa-rupiah-sign"></i>
            <span style="font-size: medium;">Keuangan</span>
        </a>
    </li>
    <li class="nav-item
    {{ Request::is('pegawai') ? 'active' : null }}
    ">
        <a class="nav-link" href="{{ route('pegawai') }}">
            <i class="fa-solid fa-user-group"></i>
            <span style="font-size: medium;">Pegawai</span>
        </a>
    </li>
    @if(Auth::user()->key_sort_unit == "07001500002000099")
    <li class="nav-item
    {{ Request::is('laporan') ? 'active' : null }}
    ">
        <a class="nav-link" href="{{ route('laporan') }}">
            <i class="fa-solid fa-file-signature"></i>
            <span style="font-size: medium;">Laporan</span>
        </a>
    </li>
    @endif
    @if(Auth::user()->role_id == 2)
    <li class="nav-item
    {{ Request::is('syncpeg') ? 'active' : null }}
    ">
        <a class="nav-link" href="{{ route('syncpeg') }}">
            <i class="fa-solid fa-rotate"></i>
            <span style="font-size: medium;">Sync Data</span>
        </a>
    </li>
    @endif

</ul>
<!-- End of Sidebar -->
