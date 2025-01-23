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

            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Your Cart</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                            <tr>
                              <th>No</th>
                              <th>Gambar</th>
                              <th>Nama</th>
                              <th>Jumlah</th>
                              <th>SubTotal</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          @forelse ($cart as $no => $item)
                          <tbody>
                            <tr>

                              <td>{{  $no+1 }}</td>
                              <td><img src="{{ asset( $item->product->gambar ) }}" alt=""></td>
                              <td>{{ $item->product->nama }}</td>
                              <td><span class="badge badge-success">{{ $item->quantity }} Kg</span></td>
                              <td>Rp. {{ $item->total }}</td>
                              <td>
                                <form action="{{ route('product.cart.delete', encrypt($item->id)) }}" method="POST">
                                    @csrf
                                    <button class="delete btn btn-sm btn-danger" >Hapus</button>
                                </form>

                            </tr>
                          </tbody>
                          @empty
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>
                          @endforelse
                          <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <th>Rp. {{ $total }}</th>
                                <th><a href="{{ route('product.cart.delete.all') }}" class="btn btn-sm btn-danger">Clear Cart</a></th>
                            </tr>
                          </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /Billing Details -->
            </div>

            <!-- Order Details -->
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Your address</h3>
                </div>
                <form action="{{ route('user.checkout') }}" method="POST">
                    @csrf
                    <input type="number" name="total" value="{{ $total }}" style="display: none">
                    <div class="order-summary">
                        <div class="form-group">
                            <textarea name="alamat" id="" cols="30" rows="10" class="input" placeholder="Your Address"></textarea>
                        </div>
                        <div class="form-group">
                            <select name="kota" id="" class="input">
                                <option value="bandar lampung">Bandar Lampung</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="input" type="tel" name="no_telp" placeholder="Telephone / Whatsapp">
                        </div>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1" value="transfer">
                            <label for="payment-1">
                                <span></span>
                                Direct Bank Transfer
                            </label>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2" value="cod">
                            <label for="payment-2">
                                <span></span>
                                Cash on Delivery (COD)
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="primary-btn order-submit">Place order</button>
                </form>
            </div>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>


@endsection
