    <div class="wrapper">
            <!--sidebar wrapper -->
            <div class="sidebar-wrapper" data-simplebar="true">
                <div class="sidebar-header">
                    <div>
                        <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                    </div>
                    <div>
                        <h4 class="logo-text">inventory</h4>
                    </div>

                </div>
                <!--navigation-->

                <ul class="metismenu" id="menu">
                    <li>
                        <a href="{{ url('/') }}">
                            <div class="parent-icon"><i class='bx bx-home-alt'></i>
                            </div>
                            <div class="menu-title">Dashboard</div>
                        </a>
                    </li>

                <li class="menu-label">Master Data</li>

                    <li>
                        <a href="{{ url('/satuan') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Satuan</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/barang') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Barang</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/gudang') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Gudang</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/katagori') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Katagori</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/staff') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Staff</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/hakakses') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Hak Akses</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/user') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">User</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/expired') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Expired</div>
                        </a>
                    </li>

                    <li class="menu-label">Transaksi</li>
                    <li>
                        <a href="{{ url('/transaksi') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Transaksi Barang Masuk</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/transaksi') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Transaksi Barang Keluar</div>
                        </a>
                    </li>

                    <li class="menu-label">Pelaporan</li>
                    <li>
                        <a href="{{ url('/laporan') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Laporan Harian</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/laporan') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Laporan Bulanan</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/laporan') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Laporan Tahunan</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/laporan') }}">
                            <div class="parent-icon"><i class='bx bx-cookie'></i>
                            </div>
                            <div class="menu-title">Invoice</div>
                        </a>
                    </li>





                </ul>
                <!--end navigation-->
            </div>
            <!--end sidebar wrapper -->
            <!--start header -->
            <header>
                <div class="topbar d-flex align-items-center">
                    <nav class="navbar navbar-expand gap-3">
                        <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                        </div>


                        <div class="top-menu ms-auto">

                        </div>
                        <div class="user-box dropdown px-3">
                            <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/icons/user.png" class="user-img" alt="user avatar">
                                <div class="user-info">
                                    <p class="user-name mb-0">admin</p>
                                    <p class="designattion mb-0">gudang</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-download fs-5"></i><span>Downloads</span></a>
                                </li>
                                <li>
                                    <div class="dropdown-divider mb-0"></div>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ ('/logout') }}"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <!--end header -->

            <!--start overlay-->
            <div class="overlay toggle-icon"></div>
            <!--end overlay-->
            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
            <!--End Back To Top Button-->
            <footer class="page-footer">
                <p class="mb-0">Copyright © 2022. All right reserved.</p>
            </footer>
        </div>
