<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #454cb3;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html" style="background-color: #FFFFFF">
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
    <li class="nav-item @if(request()->route()->uri == 'grafik-pegawai') OR @elseif(request()->route()->uri == 'grafik-keuangan') active @endif">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="false" aria-controls="collapsePages">
            <i class="fas fa-fw fa-book"></i>
            <span>Bidang 1</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
            <div class="bg-blue py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="{{ route('grafik-pegawai-b1') }}">Pegawai</a>
                <a class="collapse-item text-white" href="{{ route('grafik-keuangan') }}">Keuangan</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="false" aria-controls="collapsePages">
            <i class="fas fa-fw fa-book"></i>
            <span>Bidang 2</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
            <div class="bg-blue py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="{{ route('grafik-pegawai-b2') }}">Pegawai</a>
                <a class="collapse-item text-white" href="{{ route('grafik-keuangan') }}">Keuangan</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="false" aria-controls="collapsePages">
            <i class="fas fa-fw fa-table"></i>
            <span>Bagian Umum</span>
        </a>
        <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
            <div class="bg-blue py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="{{ route('grafik-pegawai-tu') }}">Pegawai</a>
                <a class="collapse-item text-white" href="{{ route('grafik-keuangan') }}">Keuangan</a>
            </div>
        </div>
    </li>
    @if(session('access-data-login')[0]->role_id == '2')
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages4" aria-expanded="false" aria-controls="collapsePages">
                <i class="fas fa-fw fa-screwdriver"></i>
                <span>Setting</span>
            </a>
            <div id="collapsePages4" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
                <div class="bg-blue py-2 collapse-inner rounded">
                    <a class="collapse-item text-white" href="{{ route('mapping_anggaran.index') }}">Anggaran PKAU</a>
                    <a class="collapse-item text-white" href="{{ route('mappingst.index') }}">Mapping ST</a>
                    <a class="collapse-item text-white" href="{{ route('mapping_pbj.index') }}">Mapping PBJ</a>
                    <a class="collapse-item text-white" href="{{ route('realikk.index') }}">Realisasi IKK</a>
                    <a class="collapse-item text-white" href="{{ route('users.index') }}">User Management</a>
                    <a class="collapse-item text-white" href="{{ route('syncdata') }}">Sync Data</a>
                </div>
            </div>
        </li>
    @endif
</ul>
<!-- End of Sidebar -->
