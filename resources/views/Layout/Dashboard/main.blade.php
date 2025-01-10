<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Simpeg</title>

    <link rel="icon" href="/img/logo1.png">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="/template/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    {{-- <script src="https://kit.fontawesome.com/1cfe60370c.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="/template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/template/node_modules/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/template/node_modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/template/node_modules/prismjs/themes/prism.css">
    <link rel="stylesheet" href="/template/node_modules/select2/dist/css/select2.min.css">

    <link rel="stylesheet" href="/template/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/template/node_modules/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="/template/node_modules/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="/template/node_modules/selectric/public/selectric.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>


    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="/template/assets/css/style.css">
    <link rel="stylesheet" href="/template/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">

                        <div class="sidebar-brand sidebar-brand">
                            <h6 class="title mt-3">
                                <font color="#fff"> IKSASS JAWA BARAT</font>
                            </h6>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img src="/template/assets/img/avatar/avatar-1.png" alt="Foto Pegawai"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger" id="logout-button">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#">Simpeg</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#">SI</a>
                    </div>
                    @include('Layout.Dashboard.menu')
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('container')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Developed By <a href="">Asep
                        Ripa'i</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="/template/node_modules/jquery/dist/jquery.min.js"></script>

    <script src="/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/template/node_modules/tooltip.js"></script>
    <script src="/template/node_modules/select2/dist/js/select2.full.min.js"></script>
    <script src="/template/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/template/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/template/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="/template/assets/js/page/modules-chartjs.js"></script>

    <script src="/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="/template/assets/js/stisla.js"></script>

    <script src="/template/assets/js/page/bootstrap-modal.js"></script>
    <script src="/template/node_modules/prismjs/prism.js"></script>

    <!-- JS Libraies -->
    <script src="/template/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="/template/node_modules/codemirror/lib/codemirror.js"></script>
    <script src="/template/node_modules/codemirror/mode/javascript/javascript.js"></script>
    <script src="/template/node_modules/selectric/public/jquery.selectric.min.js"></script>

    <!-- Template JS File -->
    <script src="/template/assets/js/scripts.js"></script>
    <script src="/template/assets/js/custom.js"></script>


    <!-- Page Specific JS File -->
    <script>
        document.getElementById('logout-button').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah aksi default

            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim form logout
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
</body>

</html>
