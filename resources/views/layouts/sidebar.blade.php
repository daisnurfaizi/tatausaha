<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                @if (!empty($aplication->sidebar_logo_small))
                    <img src="{{ URL::asset('storage/' . $aplication->sidebar_logo_small) }}" alt=""
                        height="22">
                @else
                    <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
                @endif
            </span>
            <span class="logo-lg">
                @if (!empty($aplication->sidebar_logo))
                    <img src="{{ URL::asset('storage/' . $aplication->sidebar_logo) }}" alt="" height="22">
                @else
                    <img src="{{ URL::asset('build/images/31530356_bird_2.jpg') }}" alt="" height="22">
                @endif
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                @if (!empty($aplication->sidebar_logo_small))
                    <img src="{{ URL::asset('storage/' . $aplication->sidebar_logo_small) }}" alt=""
                        height="22">
                @else
                    <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
                @endif
            </span>
            <span class="logo-lg">
                @if (!empty($aplication->sidebar_logo))
                    <img src="{{ URL::asset('storage/' . $aplication->sidebar_logo) }}" alt="" height="22">
                @else
                    <img src="{{ URL::asset('build/images/31530356_bird_2.jpg') }}" alt="" height="22">
                @endif
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.pages')</span></li>
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#aplication" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="aplication">
                            <i class="ri-home-gear-fill"></i>
                            <span>@lang('Aplikasi')</span>
                        </a>
                        <div class="collapse menu-dropdown" id="aplication">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.aplication') }}" class="nav-link" role="button">
                                        Aplication
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif
                @if (auth()->user()->hasRole('admin') ||
                        auth()->user()->hasRole('Kepala Sekolah'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#analitic" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="analitic">
                            <i class="mdi mdi-google-analytics"></i>
                            <span>@lang('Analytics')</span>
                        </a>
                        <div class="collapse menu-dropdown" id="analitic">
                            <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('dashboard.analitic') }}" class="nav-link" role="button">
                                        Data Analitic SPP
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                {{-- master data --}}
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-account-circle-line"></i> <span>@lang('Master Data')</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAuth">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link" role="button">Buat User
                                    </a>

                                </li>
                                {{-- permission --}}
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.datauser') }}" class="nav-link" role="button">Daftar
                                        User
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.role') }}" class="nav-link" role="button">Daftar
                                        Role
                                    </a>

                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('dashboard.datauser') }}" class="nav-link"
                                        role="button">Daftar
                                        Permission
                                    </a>

                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.student') }}" class="nav-link" role="button">Daftar
                                        Murid
                                    </a>

                                </li>

                            </ul>
                        </div>
                    </li>
                @endif

                @if (auth()->user()->hasRole('admin') ||
                        auth()->user()->hasRole('admin spp'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#payment" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="payment">
                            <i class="ri-money-dollar-circle-line"></i> <span>@lang('SPP')</span>
                        </a>
                        <div class="collapse menu-dropdown" id="payment">
                            <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('dashboard.payment') }}" class="nav-link" role="button">Input
                                        Data Spp
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.student') }}" class="nav-link"
                                        role="button">Daftar
                                        Murid
                                    </a>

                                </li>

                            </ul>
                        </div>
                    </li>
                @endif
                @if (auth()->user()->hasRole('admin') ||
                        auth()->user()->hasRole('admin surat'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#surat" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="surat">
                            <i class="mdi mdi-card-account-mail"></i>
                            <span>@lang('Surat')</span>
                        </a>
                        <div class="collapse menu-dropdown" id="surat">
                            <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('surat.suratMasuk') }}" class="nav-link" role="button">Input
                                        Surat Masuk
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('surat.suratKeluar') }}" class="nav-link" role="button">Buat
                                        Surat Keluar
                                    </a>

                                </li>

                            </ul>
                        </div>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
