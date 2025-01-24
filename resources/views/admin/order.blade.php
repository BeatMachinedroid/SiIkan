@extends('layout.app')

@section('content')

{{-- <div id="content"> --}}


    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800 text-gradient">Data Transaksi Users</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Order</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">

                <div class="card mb-4">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable" data-page-length='5'>
                            <thead class="thead-light">
                                <tr>
                                    <th style="background-color: #6777f0; color: white;">No</th>
                                    <th style="background-color: #6777f0; color: white;">Kode Order</th>
                                    <th style="background-color: #6777f0; color: white;">Customer</th>
                                    <th style="background-color: #6777f0; color: white;">Total</th>
                                    <th style="background-color: #6777f0; color: white;">Tanggal Order</th>
                                    <th style="background-color: #6777f0; color: white;">Status Bayar</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data_order as $no => $item)
                                <tr class="text-capitalize">
                                    <td>{{ $no + 1 }}</td>
                                    <td><a href="{{ route('admin.detail.order', $item->kode_order) }}">#{{ $item->kode_order }}</a></td>
                                    <td>{{ $item->name }}</td>
                                    <td>Rp. {{ $item->total }}</td>
                                    <td>{{ $item->tgl_order }}</td>
                                    <td><span class="badge
                                        @if ($item->status_pembayaran == 'Tertunda')
                                            badge-warning
                                        @else
                                            badge-success
                                        @endif
                                        ">{{ $item->status_pembayaran }}</span>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!--Row-->


        <!-- Modal create -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    <div class="modal-body">
                        <form id="fishForm" enctype="multipart/form-data" method="POST"
                            action="{{ route('admin.product.create') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="nama" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="species">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" id="species" cols="30"
                                    rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Stock">Stock</label>
                                <input type="number" class="form-control" name="stock" id="Stock" inputmode="numeric"
                                    required step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="Stock">Minimal Order</label>
                                <input type="number" class="form-control" name="min_order" id="Stock" inputmode="numeric"
                                    required step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="Harga">Harga</label>
                                <input type="number" class="form-control" name="harga" id="Harga" required step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image" id="image" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Container Fluid-->
{{-- </div> --}}

{{-- //sweet alert --}}
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
