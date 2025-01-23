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
            <div class="col-md-12">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Transaksi</h3>
                    </div>

                </div>
                <div class="card mb-4">
                    <div class="card-body">
                     <div class="table-responsive p-3">
                         <table class="table align-items-center table-flush" id="dataTable" data-page-length='5'>
                             <thead class="thead-light">
                                 <tr>
                                     <th style="background-color: #6777f0; color: white;">No</th>
                                     <th style="background-color: #6777f0; color: white;">Kode Order</th>
                                     <th style="background-color: #6777f0; color: white;">Total Bayar (Rp)</th>
                                     <th style="background-color: #6777f0; color: white;">Tanggal Order</th>
                                     <th style="background-color: #6777f0; color: white;">Status Order</th>
                                     <th style="background-color: #6777f0; color: white;">Aksi</th>
                                 </tr>
                             </thead>

                             <tbody>
                                 @forelse ($pembelian as $no => $item)
                                 <tr class="text-capitalize">
                                     <td>{{ $no + 1 }}</td>
                                     <td><a href="{{ route('user.detail.transaksi', $item->kode_order) }}">#{{ $item->kode_order }}</a></td>
                                     <td>Rp. {{ $item->total }}</td>
                                     <td>{{ $item->tgl_order}}</td>
                                     <td><span class="badge
                                         @if ($item->status_order == 'Diproses')
                                             badge-warning
                                         @else
                                             badge-primary
                                         @endif
                                         ">{{ $item->status_order }}</span>
                                     </td>
                                     <td><a class="btn btn-primary" href="{{ route('user.detail.transaksi', $item->kode_order) }}">Detail</a></td>
                                 </tr>
                                 @empty

                                 @endforelse
                             </tbody>
                             
                         </table>
                     </div>
                    </div>
                 </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>


@endsection
