@extends('layout.app')

@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800 text-gradient">Detail Transaksi Users</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.order') }}">Data Order</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Data Order</li>
        </ol>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" data-page-length='5'>
                        <thead class="thead-light">
                            <tr>
                                <th style="background-color: #6777f0; color: white;">No</th>
                                <th style="background-color: #6777f0; color: white;">Gambar produk</th>
                                <th style="background-color: #6777f0; color: white;">Jumlah Beli</th>
                                <th style="background-color: #6777f0; color: white;">Harga</th>
                                <th style="background-color: #6777f0; color: white;">Total</th>
                                <th style="background-color: #6777f0; color: white;">Status Bayar</th>
                                <th style="background-color: #6777f0; color: white;">status Order</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($data_order as $no => $item)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td><img src="{{ asset($item->ikan->gambar) }}" alt="" style="height: 100px"></td>
                                <td>{{ $item->jumlah }}Kg</td>
                                <td>Rp.{{ $item->ikan->harga }}</td>
                                <td>Rp.{{ $item->total_harga }}</td>
                                <td><span class="badge
                                        @if ($item->status_pembayaran == 'Tertunda')
                                            badge-warning
                                        @else
                                            badge-success
                                        @endif
                                        ">{{ $item->status_pembayaran }}</span>
                                </td>
                                <td><span class="badge
                                        @if ($item->status_order == 'Diproses')
                                            badge-warning
                                        @else
                                            badge-success
                                        @endif
                                        ">{{ $item->status_order }}</span>
                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between"
                    style="background-color: #6777f0; color: white;">
                    <h6 class="m-0 font-weight-bold">Data Order</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
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
                                <td>Total Item</td>
                                <td>{{ $item->jumlah_item }}</td>
                            </tr>
                            <tr>
                                <td>Ongkir</td>
                                <td>Rp. {{ $item->ongkir }}</td>
                            </tr>
                            <tr>
                                <td>Sub Total</td>
                                <td>Rp. {{ $item->total }}</td>
                            </tr>
                            <tr>
                                <td>Total Pembayaran</td>
                                <td>Rp. {{ $item->total + $item->ongkir}}</td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>
                                    @if ($item->metode == 'cod')
                                    Cash On Delivery (COD)
                                    @else
                                    {{ $item->metode }}
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
                                    @if ($item->status_pembayaran == 'Tertunda')
                                    <span class="badge badge-warning">Tertunda</span>
                                    @elseif($item->metode == 'cod')
                                    <span class="badge badge-success">Pembayaran Ditempat (COD)</span>
                                    @else
                                    <span class="badge badge-success">{{ $item->status_pembayaran }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between"
                    style="background-color: #6777f0; color: white;">
                    <h6 class="m-0 font-weight-bold">Data Costumers</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <td>Nama</td>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <td>No. Hp</td>
                                <td>{{ $item->no_telp }} <a href="https://wa.me/{{ $item->no_telp }}"
                                        class="badge badge-success">Hubungi Pembeli</a></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>{{ $item->alamat }}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between"
                    style="background-color: #6777f0; color: white;">
                    <h6 class="m-0 font-weight-bold">Data Pembayaran</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <tbody>
                            @foreach ($pembayaran as $item)

                            @if($item->status == 'Pembayaran Ditempat (COD)')
                            <tr>
                                <td class="alert alert-success" role="alert">
                                    Pembayaran Ditempat (COD)
                                </td>
                            </tr>
                            @elseif($item->status == "Diproses")
                            <tr>
                                <td class="alert alert-warning" role="alert" colspan="2">
                                    Please Confirmasi Pembayaran
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="2"><img src="{{ asset($item->bukti_pembayaran) }}" alt=""
                                        style="height: 200px; width: auto;"></td>
                            </tr>
                            <tr class="text-center">
                                <td>
                                    <a href="{{ route('admin.order.konfirmasi', $item->kode_order) }}"
                                        class="btn btn-primary">Konfirmasi Pembayaran</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.order.konfirmasi.gagal', $item->kode_order) }}"
                                        class="btn btn-danger">Gagalkan</a>
                                </td>
                            </tr>
                            @elseif($item->status == "Tertunda")
                            <tr>
                                <td class="alert alert-danger" role="alert">
                                    Tidak Ada data pembayaran
                                </td>
                            </tr>
                            @else
                            <tr class="text-center">
                                <td><img src="{{ asset($item->bukti_pembayaran) }}" alt=""
                                        style="height: 200px; width: auto;"></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    function confirmDelete(button) {
        // Show SweetAlert confirmation
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            button.closest('.delete-form').submit();
        }else{
            swal("Your item is safe!");
        }
        });

    }
</script>
@endsection