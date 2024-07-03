<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0">
            <img src=" /backend/assets/img/brand/Academic.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <img src=" /backend/assets/img/brand/academic.png">
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Navigation -->
            @can('view_dashboard')
            @if(auth()->user()->hasRole('admin'))
            <ul class="navbar-nav">
                <li class="nav-item  active">
                    <a class="nav-link  active" href="{{ route('admin.dashboard')}}">
                        <i class="ni ni-tv-2 text-primary"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user.index')}}">
                        <i class="ni ni-single-02 text-red"></i> User
                    </a>
                </li>
                <hr class="my-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.siswa.index')}}">
                        <i class="ni ni-single-02 text-yellow"></i> Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.guru.index')}}">
                        <i class="ni ni-single-02 text-green"></i> Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.jurusan.index')}}">
                        <i class="ni ni-planet text-blue"></i> Jurusan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.kelas.index')}}">
                        <i class="ni ni-building text-orange"></i> Kelas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.mapel.index')}}">
                        <i class="ni ni-folder-17 text-pink"></i> Mata Pelajaran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.jadwal.index')}}">
                        <i class="ni ni-books text-brown"></i> Jadwal
                    </a>
                </li>
                @endif
                @endcan
                @can('view_nilai')
                    @if(auth()->user()->hasRole('guru'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.nilai.index')}}">
                        <i class="ni ni-single-copy-04 text-red"></i> Input Nilai
                    </a>
                </li>

                    @endif
                @endcan
            </ul>
        </div>
    </div>
</nav>
<div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href=" /backend/index.html">Dashboard</a>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src=" /backend/assets/img/theme/team-4-800x800.jpg">
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold">Admin</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('logout')}}" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


