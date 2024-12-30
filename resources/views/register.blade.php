<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        SiIkan.com
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">

@if (Session::has('message'))
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

<section>
    <div class="page-header min-vh-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-5">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h3 class="font-weight-bolder text-info text-gradient">Welcome To SiIkan</h3>
                            <p class="mb-0">Enter your data for Sign up</p>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('proses.register') }}" method="POST">
                                @csrf
                                <label>Email</label>
                                <div class="mb-2">
                                    <input type="email" class="form-control" placeholder="Your Email" aria-label="Email"
                                        name="email" required aria-describedby="email-addon">
                                </div>
                                <label>Name</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" placeholder="Your Name" aria-label="Email"
                                        name="name" required aria-describedby="email-addon">
                                </div>
                                <label>Telphone</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" placeholder="Your Telphone"
                                        aria-label="Email" name="phone" required aria-describedby="email-addon">
                                </div>
                                <label>Address</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" placeholder="Your Address"
                                        aria-label="Email" name="address" required aria-describedby="email-addon">
                                </div>
                                <label>Password</label>
                                <div class="mb-2">
                                    <input type="password" class="form-control" placeholder="Your Password"
                                        name="password" required aria-label="Password"
                                        aria-describedby="password-addon">
                                </div>
                                <label>Confirm Password</label>
                                <div class="mb-2">
                                    <input type="password" class="form-control" placeholder="Confirm Your Password"
                                        name="password_confirmation" required autocomplete="current-password"
                                        aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mt-2 mb-0">Sign
                                        in</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-3 text-sm mx-auto">
                                have an account?
                                <a href="/login" class="text-info text-gradient font-weight-bold">Sign in</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                            style="background-image:url('../assets/img/rb_81709.png')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
  var options = {
    damping: '0.5'
  }
  Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
