<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assetss/img/logo/logo.png') }}" rel="icon">
    <title>RuangAdmin - @yield('title', 'Dashboard')</title>
    <link href="{{ asset('assetss/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assetss/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assetss/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon">
                    <img src="assetss/img/logo/logo2.png">
                </div>
                <div class="sidebar-brand-text mx-3">RuangAdmin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>
            <li class="nav-item {{ Route::currentRouteName() == 'product' ? 'active' : '' }}">
                <a class="nav-link" href="/product">
                    <i class="fas fa-fw fa-fish"></i>
                    <span>Product</span></a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'orders' ? 'active' : '' }}">
                <a class="nav-link" href="/product">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Orders</span></a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'orders' ? 'active' : '' }}">
                <a class="nav-link" href="/product">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Setting</span></a>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            @yield('content')


            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
                            <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>

    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('assetss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assetss/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetss/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assetss/js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('assetss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assetss/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assetss/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assetss/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
          $('#dataTable').DataTable();
          $('#dataTableHover').DataTable();
        });
    </script>
</body>

</html>
