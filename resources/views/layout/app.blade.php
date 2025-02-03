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
    <!-- Bootstrap DatePicker -->
    <link href="{{ asset('assetss/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="page-top">
    @if (Session::has('message') && Session::has('icon'))
    <script>
        Swal.fire({
    position: "top-end",
    icon: "{{ Session::get('icon') }}",
    title: "{{ Session::get('message') }}",
    showConfirmButton: false,
    timer: 1500
});
    </script>


    @endif
    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">

                <div class="sidebar-brand-text mx-3">SiIkan Admin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Route::currentRouteNamed('admin.dashboard') ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>
            <li class="nav-item {{ Route::currentRouteNamed('admin.category') ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.category') }}">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Category</span></a>
            </li>
            <li class="nav-item {{ Route::currentRouteNamed('admin.product') ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.product') }}">
                    <i class="fas fa-fw fa-fish"></i>
                    <span>Product</span></a>
            </li>
            <li
                class="nav-item {{ Route::currentRouteNamed('admin.order') ||  Route::currentRouteNamed('admin.detail.order') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.order') }}">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Orders</span></a>
            </li>
            <li class="nav-item {{ Route::currentRouteNamed('admin.user') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.user') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Costumers</span></a>
            </li>
            <li class="nav-item {{ Route::currentRouteNamed('admin.product.most.buying') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.product.most.buying') }}">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Product most buying</span></a>
            </li>
            <li class="nav-item {{ Route::currentRouteNamed('admin.earnings.report') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.earnings.report') }}">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Earnings ( MONTHLY )</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
                    aria-expanded="true" aria-controls="collapseTable">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Setting</span>
                </a>
                <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Seting Web</h6>
                        <a class="collapse-item" href="{{ route('admin.toko') }}">Informasi Toko</a>
                        <a class="collapse-item" href="{{ route('admin.ongkir') }}">Ongkir</a>
                    </div>
                </div>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ml-2 d-none d-lg-inline text-white small text-uppercase">{{
                                Auth::guard('admin')->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            @yield('content')

            <!-- Modal Logout -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to logout?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                            <a href="{{ route('admin.logout') }}" class="btn btn-primary">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script>
                                document.write(new Date().getFullYear());
                            </script>
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
    <script src="{{ asset('assetss/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function () {
        $('#dataTable').DataTable();
        $('#dataTables').DataTable({
            searching : false
        });
        });
    </script>

<script>
    $('#simple-date4 .input-daterange').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
      });
</script>
</body>

</html>
