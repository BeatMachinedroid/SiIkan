<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SiIkan</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />

    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.shop.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slider.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('assetss/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>


<body>
    <header>
        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="header-logo">
                            {{-- logo --}}
                            <a href="{{ route('welcome') }}" class="logo">
                                <img src="{{ asset('img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="header-search">
                            <form action="{{ route('product.search')}}" method="post">
                                @csrf
                                <input class="input" placeholder="Search here" name="search">
                                <button class="search-btn" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            {{-- cart --}}
                            @if (Auth::check())
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-user"></i>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}">LogOut</a>
                                    </li>
                                </ul>

                            </div>
                            @else
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-user"></i>
                                    <span>Your Account</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}">Register</a>
                                    </li>
                                </ul>

                            </div>
                            {{-- <div>
                                <a href="{{ route('login') }}">
                                    <i class="fa fa-user-o"></i>
                                    <span>Your Users</span></span>
                                </a>
                            </div> --}}
                            @endif

                            {{-- cart --}}
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">{{ $cart_count }}</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        @forelse ($cart as $item)
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{ asset($item->product->gambar) }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">{{ $item->product->nama }}</a></h3>
                                                <h4 class="product-price"><span class="qty">{{ $item->quantity
                                                        }}Kg</span>Rp. {{ $item->total }}</h4>
                                            </div>
                                            <form action="{{ route('product.cart.delete', encrypt($item->id)) }}"
                                                method="POST">
                                                @csrf
                                                <button class="delete"><i class="fa fa-close"></i></button>
                                            </form>
                                        </div>
                                        @empty
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#"></a></h3>
                                                <h4 class="product-price"><span class="qty"></span>Rp. 0</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                        @endforelse
                                    </div>
                                    <div class="cart-summary">
                                        <small>{{ $cart_count }} Item(s) selected</small>
                                        <h5>SUBTOTAL: Rp. {{ $total }}</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="{{ route('product.cart.checkout') }}">View Cart</a>
                                        <a href="{{ route('product.cart.checkout') }}">Checkout <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                           <!-- NAV -->
                           <ul class="main-nav nav navbar-nav">
                            <li class="{{ Route::currentRouteNamed('welcome') ? 'active' : ''  }}"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="{{ Route::currentRouteNamed('product.show') || Route::currentRouteNamed('product.detail') || Route::currentRouteNamed('product.search') || Route::currentRouteNamed('product.cart.checkout') ? 'active' : ''  }}"><a href="{{ route('product.show') }}">Product</a></li>
                            <li class="{{ Route::currentRouteNamed('transaksi')  || Route::currentRouteNamed('user.detail.transaksi')  ? 'active' : ''}}"><a href="{{ route('transaksi') }}">Transaksi</a></li>
                        </ul>
                        <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>

    @yield('content')

    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-8 col-xs-6">
                        @forelse ($toko as $tokos)
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>{{ $tokos->deskripsi }}</p><br>
                            <ul class="footer-links">
                                <li><a href="https://www.google.com/maps/search/?api=1&query={{ $tokos->nama_toko }}"><i class="fa fa-map-marker"></i>{{ $tokos->alamat_toko }}</a></li>
                                <li><a href="https://wa.me/{{ $tokos->no_telp_toko }}"><i class="fa fa-phone"></i>{{ $tokos->no_telp_toko }}</a></li>
                                <li><a href="mailto:{{ $tokos->email_toko }}"><i class="fa fa-envelope-o"></i>{{ $tokos->email_toko }}</a></li>
                            </ul>
                        </div>
                        @empty
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p></p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                        @endforelse
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="footer">
                            {{-- <div class="footer-links" style="width: 45%"> --}}
                                <div id="map"></div>
                                {{--
                            </div> --}}
                        </div>
                    </div>


                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                            aria-hidden="true"></i>

                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([-5.450000, 105.266670], 9);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);


    // Menginisialisasi array markers
    var markers = [];

    // Menggunakan Blade untuk mengisi array markers
    @foreach ($toko as $row)
        markers.push({
            lat: {{ $row->latitude }},
            lng: {{ $row->longitude }},
            // popup: '<img src="{{ asset($row->gambar) }}" style="width: 150px" class="card-img-top img-fluid mb-2"><h6 class="text-capitalize">{{ $row->nama_toko }}</h6>'
        });
    @endforeach

        // Menambahkan marker ke peta
        markers.forEach(function(marker) {
            L.marker([marker.lat, marker.lng]).addTo(map);
                // .bindPopup(marker.popup).openPopup();
        });

    </script>
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
