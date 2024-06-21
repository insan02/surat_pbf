<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISFO SM BEM HIMA SE-UNAND</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="/unand.png" type="image/png">

    <style>
        /* Background hijau untuk sidebar */
        .main-sidebar {
            background-color: #009A4B !important;
        }

        /* Ketika hover atau aktif, ubah background menjadi putih dan teks menjadi hitam */
        .nav-sidebar .nav-link:hover,
        .nav-sidebar .nav-link:focus,
        .nav-sidebar .nav-link:active {
            background-color: #ffffff !important;
            color: #000000 !important;
        }

        /* Warna teks putih untuk tulisan menu */
        .nav-sidebar .nav-link {
            color: #ffffff !important;
        
        /* Aturan untuk gambar */
        img.unand {
            width: 40px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-top: 0px;
        }
        }
    </style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="/adminlte/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
    <!-- DataTable -->
    <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-user mr-2"></i> &nbsp;<span>{{auth()->user()->name}}</span> &nbsp;<i
                            class="icon-submenu lnr lnr-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Profil</span>
                        <div class="dropdown-divider"></div>
                        <a href="/profil" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Lihat Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout" class="dropdown-item" onclick="showLogoutPopup()">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-1">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="mt-3 pb-3 mb-4 text-center">
                    <img src="/unand.png" alt="Unand Logo" style="width: 60px; max-width: 60px;">
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        @if (Auth::check())
                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a href="/dashboard" class="nav-link">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pengguna.index') }}" class="nav-link">
                                        <i class="fas fa-users-cog nav-icon"></i>
                                        <p>Manajemen Akun</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/kategori/index" class="nav-link">
                                        <i class="nav-icon fas fa-layer-group"></i>
                                        <p>Kategori Surat</p>
                                    </a>
                                    <hr>
                                </li>
                            @elseif (Auth::user()->role === 'user')
                                <li class="nav-item">
                                    <a href="/home" class="nav-link">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>Home</p>
                                    </a>
                                </li>
                            @endif
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('instansi.index') }}" class="nav-link">
                                <i class="fas fa-warehouse nav-icon"></i>
                                <p>Profil Instansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dokumen/index" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Dokumen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/template/index" class="nav-link">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Template</p>
                            </a>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a href="/suratmasuk/index" class="nav-link">
                                <i class="far fa-envelope nav-icon"></i>
                                <p>Surat Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/suratkeluar/index" class="nav-link">
                                <i class="far fa-envelope-open nav-icon"></i>
                                <p>Surat Keluar</p>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background: #192192192; padding: 15px 15px 15px 15px ">

            @yield('content')

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>SISFO SURAT MENYURAT BEM HIMA SE-UNAND</b>
            </div>
            Copyright &copy; 2024 | by : UNAND
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/adminlte/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/js/adminlte.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Filterizr-->
    <script src="/adminlte/plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- Data Table -->
    <script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/adminlte/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#tabelSuratmasuk").DataTable();
            $("#tabelSuratkeluar").DataTable();
            $("#tabelAgendaMasuk").DataTable();
            $("#tabelAgendaKeluar").DataTable();
            $("#tabelKategori").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
            });
        });

        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function () {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
</body>

</html>

