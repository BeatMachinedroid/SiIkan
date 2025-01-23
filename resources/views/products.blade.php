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


            <div id="store" class="col-md-9">
                <!-- store products -->
                <div class="row">

                    @forelse ($products as $item)
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ asset($item->gambar) }}" alt="">
                                <div class="product-label">
                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $item->deskripsi }}</p>
                                <h3 class="product-name"><a href="{{ route('product.detail' , encrypt($item->id)) }}">{{ $item->nama }}</a></a></h3>
                                <h4 class="product-price">Rp. {{ $item->harga }}</h4>
                            </div>
                            <div class="add-to-cart">
                                @if (Auth::check())
                                <form action="{{ route('product.add.cart') }}" method="POST">
                                    @csrf
                                    <input type="text" name="product_id" value="{{ encrypt($item->id) }}" style="display: none">
                                    <input type="text" name="user_id" value="{{ encrypt( Auth::user()->id) }}" style="display: none">
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
