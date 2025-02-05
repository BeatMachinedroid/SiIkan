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

    <div id="content-wrapper" class="d-flex flex-column" style="display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;">
          <div class="text-center" >
            <img src="{{ asset('assetss/img/error.svg') }}" style="max-height: 100px;" class="mb-3">
            <h3 class="text-gray-800 font-weight-bold">Oopss !!!</h3>
            <p class="lead text-gray-800 mx-auto">404 Page Not Found</p>
            <a class="btn btn-primary text-white" onclick="window.history.back();">&larr; Back to Dashboard</a>
          </div>
    </div>

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

