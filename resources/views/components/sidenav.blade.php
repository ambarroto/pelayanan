<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
    <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="../../pages/dashboards/dashboard.html">
            <img src="../../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
            <!-- Sidenav toggler -->
            <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                </div>
            </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Nav items -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ route_name_is('home') }}" href="{{ url('/') }}">
                        <i class="ni ni-shop text-primary"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ route_name_is('peta') }}" href="{{ route('peta') }}">
                        <i class="fas fa-map-marked-alt text-green"></i>
                        <span class="nav-link-text">Peta Wilayah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ route_name_is('surat_masuk') }}" href="{{ route('surat_masuk') }}">
                        <i class="ni ni-email-83 text-green"></i>
                        <span class="nav-link-text">Surat Masuk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ route_name_is('surat_keluar') }}" href="{{ route('surat_keluar') }}">
                        <i class="ni ni-delivery-fast text-orange"></i>
                        <span class="nav-link-text">Surat Keluar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#arsip" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="arsip">
                        <i class="ni ni-archive-2 text-teal"></i>
                        <span class="nav-link-text">Arsip</span>
                    </a>
                    <div class="collapse show" id="arsip">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#pelayanan" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="pelayanan">
                                    <i class="ni ni-archive-2 text-teal"></i>
                                    <span class="nav-link-text">Pelayanan Publik</span>
                                </a>
                                <div class="collapse show" id="pelayanan">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_dispensiasi_nikah') }}" class="nav-link">Dispensiasi Nikah</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_pelayanan_ktp') }}" class="nav-link">Pelayanan KTP</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_skm') }}" class="nav-link">Survey Kepuasan Masyarakat (SKM)</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pm" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="pm">
                                    <i class="ni ni-archive-2 text-teal"></i>
                                    <span class="nav-link-text">Pemberdayaan Masyarakat</span>
                                </a>
                                <div class="collapse show" id="pm">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_rekap_data') }}" class="nav-link">Rekap Data</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_laporan_realisasi_apbdes') }}" class="nav-link">Laporan Realisasi APBDes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_lpj_bumdes') }}" class="nav-link">LPJ Bumdes</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a href="#" class="nav-link">Laporan Dana Desa</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_administrasi_desa') }}" class="nav-link">Administrasi Desa</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a href="#" class="nav-link">Laporan Alokasi Dana Desa</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#kepegawaiwan" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="kepegawaiwan">
                                    <i class="ni ni-archive-2 text-teal"></i>
                                    <span class="nav-link-text">Kepegawaian</span>
                                </a>
                                <div class="collapse show" id="kepegawaiwan">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_sk_cpns') }}" class="nav-link">SK CPNS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_sk_pns') }}" class="nav-link">SK PNS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_pendidikan') }}" class="nav-link">Pendidikan</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a href="#" class="nav-link">Berkala</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_pangkat') }}" class="nav-link">Kenaikan Pangkat</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('arsip_skp') }}" class="nav-link">SKP</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#administrasi_pegawai" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="administrasi_pegawai">
                        <i class="ni ni-archive-2 text-teal"></i>
                        <span class="nav-link-text">Administrasi</span>
                    </a>
                    <div class="collapse show" id="administrasi_pegawai">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('administrasi_pegawai') }}" class="nav-link">Pegawai</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrasi_seksi') }}" class="nav-link">Seksi</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrasi_desa') }}" class="nav-link">Desa</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('skck') }}">
                        <i class="ni ni-single-copy-04 text-pink"></i>
                        <span class="nav-link-text">SKCK</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('imb') }}">
                        <i class="ni ni-single-copy-04 text-primary"></i>
                        <span class="nav-link-text">IMB</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ijin_keramaian') }}">
                        <i class="ni ni-notification-70 text-green"></i>
                        <span class="nav-link-text">Ijin Keramaian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('surat_keterangan') }}">
                        <i class="ni ni-book-bookmark text-red"></i>
                        <span class="nav-link-text">Surat Keterangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dispensiasi_nikah') }}">
                        <i class="ni ni-tie-bow text-green"></i>
                        <span class="nav-link-text">Dispensiasi Nikah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kedatangan') }}">
                        <i class="ni ni-archive-2 text-teal"></i>
                        <span class="nav-link-text">Kedatangan</span>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-archive-2 text-teal"></i>
                        <span class="nav-link-text">Pindah Tempat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
                        <i class="ni ni-archive-2 text-teal"></i>
                        <span class="nav-link-text">Pindah Tempat</span>
                    </a>
                    <div class="collapse show" id="navbar-dashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Antar Desa</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Antar Kecamatan</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Antar Kabupaten/Kota</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading p-0 text-muted">Documentation</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">
                    <i class="ni ni-spaceship"></i>
                    <span class="nav-link-text">Getting started</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">
                    <i class="ni ni-palette"></i>
                    <span class="nav-link-text">Foundation</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html" target="_blank">
                    <i class="ni ni-ui-04"></i>
                    <span class="nav-link-text">Components</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                    <i class="ni ni-chart-pie-35"></i>
                    <span class="nav-link-text">Plugins</span>
                </a>
                </li>
            </ul>
            </div>
        </div>
    </div>
</nav>