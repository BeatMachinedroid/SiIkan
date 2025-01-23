@extends('layout.appindex')

@section('content')

<script>
    // Misalkan $item->qty sudah didefinisikan di PHP
        var itemQty = {{ $min_order }}; // Ambil nilai qty dari PHP

    // Fungsi untuk memperbarui quantity
    function updateQuantity(increment) {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value) || 0;

        // Tentukan kelipatan berdasarkan genap atau ganjil
        var step = (itemQty % 2 === 0) ? 2 : 1; // Jika genap, langkah 2; jika ganjil, langkah 1

        // Update quantity
        quantityInput.value = currentQuantity + step * increment;
    }

    // Event listener untuk tombol tambah
    document.getElementById('increase').addEventListener('click', function() {
        updateQuantity(1);
    });

    // Event listener untuk tombol kurang
    document.getElementById('decrease').addEventListener('click', function() {
        updateQuantity(-1);
    });
</script>

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
    <div class="container">
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 ">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="{{ asset($product->gambar) }}" alt="">
                    </div>
                </div>
            </div>

            <!-- Product details -->
            <div class="col-md-5 col-md-push-1">
                <div class="product-details">
                    <h2 class="product-name">{{ $product->nama }}</h2>
                    <div>
                        <h3 class="product-price">Rp. {{ $product->harga }}</h3>
                        <span class="product-available">@if ($product->stock > 0 ) Available @else Out of Stock @endif</span>
                    </div>
                    <p>{{ $product->deskripsi }}</p>

                    <p class="mb-4" style="color: red; font-size:small;"> *Minimal Pembelian {{ $min_order }} kg</p>

                    @if (Auth::check())
                    <form action="{{ route('product.add.detail.cart') }}" method="POST">
                        @csrf
                        <input type="text" name="product_id" value="{{ encrypt($product->id) }}" style="display: none">
                        <input type="text" name="user_id" value="{{ encrypt(Auth::user()->id) }}" style="display: none">
                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" value="{{ $min_order }}" name="quantity" id="quantity">
                                    <span class="qty-up" id="increase">+</span>
                                    <span class="qty-down" id="decrease">-</span>
                                </div>
                            </div>
                            <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                    </form>
                    @else
                    <form action="{{ route('product.add.detail.cart') }}" method="POST">
                        @csrf
                        <input type="text" name="product_id" value="" style="display: none">
                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" value="1">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                    </form>
                    @endif

                </div>
            </div>
            <!-- /Product details -->
        </div>
    </div>
</div>

@endsection
