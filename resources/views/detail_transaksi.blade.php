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
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="billing-details">
                <div class="section-title">
                    <h3 class="title">Order Details #{{ $kode }}</h3>
                </div>
            </div>
            <div class="col-md-7">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="background-color: #6777f0; color: white;">Product</th>
                                <th style="background-color: #6777f0; color: white;">Nama Product</th>
                                <th style="background-color: #6777f0; color: white;">Jumlah Beli</th>
                                <th style="background-color: #6777f0; color: white;">Sub Total (Rp)</th>
                                {{-- <th class="text-center" style="background-color: #6777f0; color: white;">Status
                                </th>
                                <th class="text-center" style="background-color: #6777f0; color: white;">Aksi</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pembelian as $item)
                            <tr>
                                <td><img src="{{ asset($item->ikan->gambar) }}" alt=""
                                        style="height: 100px; width: auto;"></td>
                                <td>{{ $item->ikan->nama }}</td>
                                <td>{{ $item->jumlah }} Kg</td>
                                <td>Rp. {{ $item->total_harga }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="3" style="background-color: #6777f0; color: white;">
                                    Total</th>
                                @foreach ($order as $item)
                                <th style="background-color: #6777f0; color: white;">Rp. {{ $item->total }}</th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

            <div class="col-md-5">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="background-color: #6777f0; color: white;" colspan="2">
                                    Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $item)
                            @if ($item->bukti_pembayaran == null && $item->status == 'Tertunda')
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-danger" role="alert">
                                        Anda Belum melakukan pembayaran!! Atau mengirimkan bukti pembayaran !
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td>
                                    <form action="{{ route('user.upload.bukti') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="kode_order" value="{{ $item->kode_order }}" style="display: none">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="bukti" id="image" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Upload Bukti Pembayaran</button>
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                            @elseif($item->status == 'Tertunda')
                            <td colspan="2">
                                <div class="alert alert-success" role="alert">
                                    Pembayaran telah dikonfirmasi, tekan barang diterima setelah menerima barang!
                                </div>
                            </td>
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset($item->bukti_pembayaran) }}" alt="" style="height: 200px; width: auto;" >
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td>
                                    <a href="{{ route('user.konfirmasi.barang', $item->kode_order) }}" class="btn btn-primary">Barang Diterima</a>
                                </td>
                            </tr>
                            @elseif($item->status == "Pembayaran Ditempat (COD)" && $item->tanggal_pembayaran == null)
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-success" role="alert">
                                        Pembayaran Ditempat (COD)!
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td>
                                    <a href="{{ route('user.konfirmasi.barang', $item->kode_order) }}" class="btn btn-primary">Barang Diterima</a>
                                </td>
                            </tr>
                            @elseif($item->status == "Pembayaran Ditempat (COD)" && $item->tanggal_pembayaran !== null)
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-success" role="alert">
                                        Pembayaran telah dikonfirmasi, barang diterima!
                                    </div>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="2">
                                    <div class="alert alert-success" role="alert">
                                        Pembayaran telah dikonfirmasi, barang diterima!
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset($item->bukti_pembayaran) }}" alt="" style="height: 200px; width: auto;" >
                                </td>
                            </tr>
                            @endif

                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="background-color: #6777f0; color: white;" colspan="2">
                                    Data Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <td>Nomor</td>
                                <td>#{{ $item->kode_order }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Order</td>
                                <td>{{ $item->tgl_order }}</td>
                            </tr>
                            <tr>
                                <td>Tenggat Waktu</td>
                                <td>{{ $item->batas_bayar }}</td>
                            </tr>
                            <tr>
                                <td>Total Item</td>
                                <td>{{ $item->jumlah_item }}</td>
                            </tr>
                            <tr>
                                <td>Ongkir</td>
                                <td>Rp.{{ $item->ongkir }}</td>
                            </tr>
                            <tr>
                                <td>Sub Total</td>
                                <td>Rp.{{ $item->total }}</td>
                            </tr>
                            <tr>
                                <td>Total Pembayaran</td>
                                <td>Rp.{{ $item->total + $item->ongkir }}</td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>
                                    @if ($item->metode == 'cod')
                                    Cash On Delivery (COD)
                                    @else
                                    Transfer Bank
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Status Order</td>
                                <td>
                                    @if ($item->status_order == 'Diproses')
                                    <span class="badge badge-warning">{{ $item->status_order }}</span>
                                    @else
                                    <span class="badge badge-success">{{ $item->status_order }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>
                                    @if ($item->metode == 'transfer' && $item->status_pembayaran == null)
                                    <span class="badge badge-warning">Tertunda</span>
                                    @elseif($item->metode == 'cod')
                                    <span class="badge badge-success">Pembayaran Ditempat (COD)</span>
                                    @else
                                    <span class="badge badge-success">{{ $item->status_pembayaran }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Cetak Invoice</td>
                                <td><a href="" class="btn btn-primary">cetak</a>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
</div>


@endsection
