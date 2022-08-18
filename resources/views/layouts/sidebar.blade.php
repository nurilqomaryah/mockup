<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html" style="background-color: #FFFFFF">
        <div class="sidebar-brand-icon">
            <img class="logo-img" src="{{url('/images/BPKP_Logo.png')}}" width="50%">
        </div>
{{--        <div class="sidebar-brand-text mx-3">Puslitbangwas</div>--}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <!-- Nav Item - DashboardController -->
    @if(\Illuminate\Support\Facades\Session::get('role') == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{url('dashboardadmin')}}">
            <i class="fas fa-chart-bar"></i>
            <span>DASHBOARD</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('manajemenuser')}}">
            <i class="fas fa-user-alt"></i>
            <span>BIDANG 1</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('manajemenrole')}}">
            <i class="far fa-address-card"></i>
            <span>Management Role</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('manajemencategory')}}">
            <i class="far fa-calendar-alt"></i>
            <span>Management Category</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('manajementag')}}">
            <i class="fas fa-tags"></i>
            <span>Management Tag</span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{url('manajemenproduct')}}">
        <i class="fas fa-tasks"></i>
        <span>Management Product</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('manajemenpost')}}">
            <i class="far fa-newspaper"></i>
            <span>Management Post</span></a>
    </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{url('dashboardauthor')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>DASHBOARD</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('manajemenproduct')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>BIDANG 1</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('manajemenpost')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>BIDANG 2</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('manajemenpost')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>BAGIAN UMUM</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('manajemenpost')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>PENGATURAN</span></a>
        </li>
    @endif
</ul>
<!-- End of Sidebar -->
