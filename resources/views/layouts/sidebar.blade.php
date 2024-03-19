<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!--logo-->
    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo-smk.JPG') }}" width="50">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Perpusta</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <!--end logo-->
    <ul class="menu-inner py-4">
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Admin</span></li>
        <!-- Apps -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="bx bx-layout bx-border" style="margin-right: 10px;"></i>
                <div class="text-truncate" data-i18n="Layouts">Buku</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('buku.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Content navbar">Koleksi Buku</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('kategori.create') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Content nav + Sidebar">Kategori Buku</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="bx bx-layout bx-border" style="margin-right: 10px;"></i>
                <div class="text-truncate" data-i18n="Layouts">Laporan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.peminjaman') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Content navbar">Laporan Peminjaman</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.pengguna') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Content nav + Sidebar">Laporan Pengguna</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('buku.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Content nav + Sidebar">Laporan Buku</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Admin</span></li>
            <li class="menu-item">
                <a href="{{ route('list.buku') }}" class="menu-link">
                    <i class="bx bx-home bx-border" style="margin-right: 10px;"></i>
                    <div data-i18n="Dashboards">Beranda</div>
                </a>
                <a href="{{ route('pinjam.index') }}" class="menu-link">
                    <i class="bx bx-folder bx-border" style="margin-right: 10px;"></i>
                    <div data-i18n="Dashboards">Peminjaman</div>
                </a>
                <a href="{{ route('koleksi.index') }}" class="menu-link">
                    <i class="bx bx-heart bx-border" style="margin-right: 10px;"></i>
                    <div data-i18n="Dashboards">Koleksi</div>
                </a>
            </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Admin</span></li>
        <li class="menu-item">
            <a href="{{ route('kategori.show') }}" class="menu-link">
                <i class="bx bx-cog bx-border" style="margin-right: 10px;"></i>
                <div data-i18n="Dashboards">Setting</div>
            </a>
            <div class="logout-form-container">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out bx-border" style="margin-right: 10px;"></i>
                    <div data-i18n="Dashboards">Log Out</div>
                </a>
            </div>
        </li>
    </ul>
</aside>
