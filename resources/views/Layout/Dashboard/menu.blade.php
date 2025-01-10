<ul class="sidebar-menu">


    <li class="nav-item {{ Request::is('petugas/pengajuan-cuti') ? 'active' : '' }}">
        <a class="nav-link" href="/petugas/pengajuan-cuti"> <i class="fas fa-calendar-check"></i></i> <span>Pengajuan
                Cuti</span></a>
    </li>
    <li class="nav-item {{ Request::is('petugas/kgb') ? 'active' : '' }}">
        <a class="nav-link" href="/petugas/kgb"><i class="fas fa-money-check-alt"></i><span>KGB</span></a>
    </li>

</ul>
