<ul class="sidebar-menu">
    <li class="menu-header">Menu Utama</li>

    <!-- Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Berita -->
    <li class="nav-item {{ Request::is('dashboard/posts') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard/posts">
            <i class="fas fa-calendar-check"></i>
            <span>News</span>
        </a>
    </li>

    <!-- Data Alumni -->
    <li class="nav-item {{ Request::is('petugas/kgb*') ? 'active' : '' }}">
        <a class="nav-link" href="/petugas/kgb">
            <i class="fas fa-money-check-alt"></i>
            <span>Data Alumni</span>
        </a>
    </li>
</ul>
