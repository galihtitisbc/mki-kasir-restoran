    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('/dashboard/home') }}"
                            class="nav-link {{ request()->segment(2) == 'home' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/dashboard/laporan') }}"
                            class="nav-link {{ request()->segment(2) == 'laporan' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>
                                Laporan Transaksi
                            </p>
                        </a>
                    </li>

                    {{-- <li class="nav-header">EXAMPLES</li> --}}
                    @hasanyrole('SUPERVISOR|ADMIN')
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/pegawai') }}"
                                class="nav-link {{ request()->segment(2) == 'pegawai' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                                <p>
                                    Kelola Pegawai
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/produk') }}"
                                class="nav-link {{ request()->segment(2) == 'produk' ? 'active' : '' }}">
                                <i class="fa fa-cube" aria-hidden="true"></i>
                                <p>
                                    Kelola Produk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/opsi-produk') }}"
                                class="nav-link {{ request()->segment(2) == 'opsi-produk' ? 'active' : '' }}">
                                <i class="fa fa-coffee" aria-hidden="true"></i>
                                <p>
                                    Kelola Opsi Produk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/kategori') }}"
                                class="nav-link {{ request()->segment(2) == 'kategori' ? 'active' : '' }}">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Kelola Kategori Produk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/supplier') }}"
                                class="nav-link {{ request()->segment(2) == 'supplier' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-address-book"></i>
                                <p>
                                    Kelola Supplier
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/bahan') }}"
                                class="nav-link {{ request()->segment(2) == 'bahan' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-book"></i>
                                <p>
                                    Kelola Bahan Produk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/stock/') }}"
                                class="nav-link {{ request()->segment(2) == 'stock' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Kelola Stok Bahan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/pajak') }}"
                                class="nav-link {{ request()->segment(2) == 'pajak' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-credit-card" aria-hidden="true"></i>
                                <p>
                                    Kelola Pajak
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            @role('SUPERVISOR')
                                <a href="#" class="nav-link {{ request()->segment(2) == 'outlet' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Kelola Outlet
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/dashboard/outlet') }}"
                                            class="nav-link {{ request()->segment(2) == 'outlet' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Daftar Outlet</p>
                                        </a>
                                    </li>
                                @endrole
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard/meja') }}"
                                        class="nav-link {{ request()->segment(2) == 'meja' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kelola Meja Outlet</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endhasanyrole
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
