<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav">
        <li class="no-arrow" style="text-align: left; font-weight: bold; font-size: larger;">
            <span class="judul orange">MO</span><span class="judul blue">NITORING </span><span class="judul orange">C</span><span class="judul blue">APAIAN </span><span class="judul orange">K</span><span class="judul blue">INERJA DAN KE</span><span class="judul orange">U</span><span class="judul blue">ANGAN </span><span class="judul orange">P</span><span class="judul blue">KAU/PKPT</span>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="dropdown-item" href="">
            {{ \Illuminate\Support\Facades\Auth::user()->nama }}
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="dropdown-item" href="{{ route('logout') }}">
                <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>
