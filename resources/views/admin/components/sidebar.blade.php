<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.profil-lppm') }}">
        <div class="sidebar-brand-icon">
            <i><img src="{{ asset('assets/img/favicon.ico') }}" alt=""></i>
        </div>
        <div class="sidebar-brand-text mx-3">LPPM STMIK PONTIANAK</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Heading -->
    <div class="sidebar-heading">Menu</div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
            aria-bs-expanded="true" aria-bs-controls="collapseTwo">
            <i class="fas fa-fw fa-lightbulb"></i>
            <span>PKM</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="{{ route('admin.daftar-proposal-pkm') }}">Daftar Proposal</a>
                <a class="collapse-item" href="{{ route('admin.daftar-laporan-pkm') }}">Daftar Laporan</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider" />
    <!-- Heading -->
    <div class="sidebar-heading">User</div>
    
    <!-- Nav Item - Dosen -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.data-dosen') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Dosen</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block" />
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
