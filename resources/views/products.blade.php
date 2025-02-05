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
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Kategori</h3>
                    @foreach ($categories as $item)
                    <div class="checkbox-filter">
                        <div class="input-checkbox">
                            <i class="fa fa-caret-down"></i>
                            <a href="{{ route('search.product',$item->nama) }}">
                                <label for="category-1">
                                    <span></span>
                                    {{ $item->nama }}
                                    <small>( {{ $item->ikan_count }} )</small>
                                </label>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Top selling</h3>
                    @foreach ($top_sell as $item)
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="{{ asset($item->ikan->gambar) }}" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a href="{{ route('product.detail', encrypt($item->id_ikan)) }}">{{ $item->ikan->nama }}</a></h3>
                            <h4 class="product-price">Rp. {{ $item->ikan->harga }}</h4>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- /aside Widget -->
            </div>

            <div id="store" class="col-md-9">
                <!-- store products -->
                <div class="row">

                    @forelse ($products as $item)
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ asset($item->gambar) }}" alt="" style="height: 200px">
                                <div class="product-label">
                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $item->deskripsi }}</p>
                                <h3 class="product-name"><a href="{{ route('product.detail' , encrypt($item->id)) }}">{{
                                        $item->nama }}</a></a></h3>
                                <h4 class="product-price">Rp. {{ $item->harga }}</h4>
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
                    </div>
                    @empty
                    <div class="col-12">
                        <p>No products available.</p>
                    </div>
                    @endforelse

                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    <span class="store-qty">Showing {{ $products->count() }} of {{ $products->total() }} products</span>
                    <ul class="store-pagination">
                        {{ $products->links() }}
                        <!-- Laravel's built-in pagination links -->
                    </ul>
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>


@endsection
