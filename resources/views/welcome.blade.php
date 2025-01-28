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
<style>
    .transparent-button {
        background-color: transparent;
        /* Latar belakang transparan */
        border: 0px #007bff00;
    }

    */
</style>

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            @foreach ($categories as $item)
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset($item->gambar) }}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>{{ $item->nama }}</h3>
                        <form action="{{ route('product.search') }}" method="POST">
                            @csrf
                            <input type="hidden" name="search" value="{{ $item->nama }}">
                            <button type="submit" class="transparent-button cta-btn">Shop now <i
                                    class="fa fa-arrow-circle-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- /shop -->

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
                                    <a href="{{ route('product.detail', encrypt($item->id)) }}">
                                        <div class="product-img">
                                            <img src="{{ asset($item->gambar) }}" alt="">
                                            <div class="product-label">
                                                {{-- <span class="sale">-30%</span> --}}
                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $item->deskripsi }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('product.detail' , encrypt($item->id)) }}">{{ $item->nama
                                                    }}</a></h3>
                                            <h4 class="product-price">Rp. {{ $item->harga }}
                                                {{-- <del class="product-old-price">$990.00</del> --}}
                                            </h4>
                                        </div>
                                    </a>
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
                    <h3 class="title">Top Sales</h3>

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
                                @forelse ($top_sell as $item)
                                <!-- product -->
                                <div class="product">
                                    <a href="{{ route('product.detail', encrypt($item->ikan->id)) }}">
                                        <div class="product-img">
                                            <img src="{{ $item->ikan->gambar }}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $item->deskripsi }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('product.detail' , encrypt($item->ikan->id)) }}">{{
                                                    $item->ikan->nama
                                                    }}</a></h3>
                                            <h4 class="product-price">Rp. {{ $item->ikan->harga }}
                                                {{-- <del class="product-old-price">$990.00</del> --}}
                                            </h4>
                                        </div>
                                    </a>
                                    <div class="add-to-cart">
                                        @if (Auth::check())
                                        <form action="{{ route('product.add.cart') }}" method="POST">
                                            @csrf
                                            <input type="text" name="product_id" value="{{ encrypt($item->ikan->id) }}"
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
                                            <input type="text" name="product_id" value="{{ encrypt($item->ikan->id) }}"
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
