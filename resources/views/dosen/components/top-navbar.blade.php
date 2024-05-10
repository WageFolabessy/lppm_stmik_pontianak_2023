<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown"
                aria-bs-haspopup="true" aria-bs-expanded="true">
                <i class="fas fa-bell fa-fw text-gray-900"></i>
                <!-- Counter - Alerts -->
                @if (Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                    <span class="badge badge-danger badge-counter">{{ Auth::user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-left shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Notifikasi</h6>
                @if (Auth::check() && Auth::user()->unreadNotifications
                    && Auth::user()->unreadNotifications->count() > 0)
                    @foreach (Auth::user()->unreadNotifications as $notification)
                        @if ($notification->type == 'App\Notifications\StatusPkmProposal')
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('dosen.proposal-saya') }}">
                                <div class="mr-3">
                                    @if ($notification->data['status'] == 'Disetujui')
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                    @else
                                        <div class="icon-circle bg-danger">
                                            <i class="fas fa-times text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{ $notification->data['tanggal'] }}</div>
                                    <span class="font-weight-bold">
                                        Proposal dengan judul "{{ $notification->data['judul'] }}"
                                        {{ $notification->data['status'] }}
                                    </span>
                                </div>
                            </a>
                        @elseif ($notification->type == 'App\Notifications\KomentarPkmProposal')
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('dosen.proposal-saya') }}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-secondary">
                                        <i class="fas fa-comments text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{ $notification->data['tanggal'] }}</div>
                                    <span class="font-weight-bold">
                                        Proposal dengan judul "{{ $notification->data['judul'] }}"
                                        telah dikomentari
                                    </span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                @else
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div>
                            <span class="font-weight-bold">
                                Tidak ada notifikasi baru
                            </span>
                        </div>
                    </a>
                @endif
                @if (Auth::user()->unreadNotifications->count() > 0)
                    <a class="dropdown-item text-center small text-gray-500" href="{{ route('notif.read') }}">
                        Tandai Sudah Dibaca
                    </a>
                @endif
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-bs-toggle="dropdown" aria-bs-haspopup="true" aria-bs-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-900 small">{{ Auth::user()->nama }}</span>
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-900"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('dosen.profil-dosen') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-900"></i>
                    Profil
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="dropdown-item" type="submit">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-900"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->
