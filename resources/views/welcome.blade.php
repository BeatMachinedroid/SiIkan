@extends('layout.appindex')

@section('content')
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


<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('img/nila.jpg') }}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Ikan Nila</h3>
                        <a href="{{ route('product.show') }}" class="cta-btn">Shop now <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('img/lele.jpeg') }}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Ikan Lele</h3>
                        <a href="{{ route('product.show') }}" class="cta-btn">Shop now <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('img/patin.jpg') }}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Ikan Patin</h3>
                        <a href="{{ route('product.show') }}" class="cta-btn">Shop now <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <h2 class="text-uppercase">free ongkir for your first transaction</h2>
                    {{-- <p>Free ongkir </p> --}}
                    <a class="primary-btn cta-btn" href="{{ route('product.show') }}">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>

                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                @forelse ($products as $item)
                                <!-- product -->
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{ $item->gambar }}" alt="">
                                        <div class="product-label">
                                            {{-- <span class="sale">-30%</span> --}}
                                            <span class="new">NEW</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $item->deskripsi }}</p>
                                        <h3 class="product-name"><a href="{{ route('product.detail' , encrypt($item->id)) }}">{{ $item->nama }}</a></h3>
                                        <h4 class="product-price">Rp. {{ $item->harga }}
                                            {{-- <del class="product-old-price">$990.00</del> --}}
                                        </h4>
                                    </div>
                                    <div class="add-to-cart">
                                        @if (Auth::check())
                                        <form action="{{ route('product.add.cart') }}" method="POST">
                                            @csrf
                                            <input type="text" name="product_id" value="{{ encrypt($item->id) }}"
                                                style="display: none">
                                            <input type="text" name="user_id" value="{{ encrypt( Auth::user()->id) }}"
                                                style="display: none">
                                            <input type="text" name="jumlah" value="1" style="display: none">

                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </form>
                                        @else
                                        <form action="{{ route('product.add.cart') }}" method="POST">
                                            @csrf
                                            <input type="text" name="product_id" value="{{ encrypt($item->id) }}"
                                                style="display: none">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <!-- /product -->
                                @empty

                                @endforelse
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>






@endsection
