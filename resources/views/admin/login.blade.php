<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assetss/img/logo/logo.png" rel="icon">
    <title>RuangAdmin - Login</title>
    <link href="assetss/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assetss/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assetss/css/ruang-admin.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gradient-login">
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
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form action="{{ route('proses.admin.login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail"
                                                aria-describedby="emailHelp" placeholder="Enter Email Address" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="assetss/vendor/jquery/jquery.min.js"></script>
    <script src="assetss/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assetss/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assetss/js/ruang-admin.min.js"></script>
</body>

</html>