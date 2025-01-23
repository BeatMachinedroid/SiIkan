@extends('layout.app')

@section('content')

{{-- <div id="content"> --}}


    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800 text-gradient">Data Toko</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Toko</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table align-items-center table-flush" id="dataTable" data-page-length='5'>
                            <thead class="thead-light">
                                <tr>
                                    <th style="background-color: #6777f0; color: white;">No</th>
                                    <th style="background-color: #6777f0; color: white;">Jenis</th>
                                    <th style="background-color: #6777f0; color: white;">Ongkir</th>
                                    <th style="background-color: #6777f0; color: white;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($ongkir as $no => $item)

                                <tr class="text-capitalize">
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->jenis }}</td>
                                    <td>Rp. {{ $item->ongkir }}</td>
                                    <td>
                                        {{-- <a href="#" class="btn btn-sm btn-warning me-1" data-toggle="modal"
                                            data-target="#exampleModalCenterUpdate{{ $item->id }}" id="#modalCenter"><i
                                                class="fas fa-edit"></i>
                                        </a> --}}

                                        <!-- Modal update -->
                                        {{-- <div class="modal fade" id="exampleModalCenterUpdate{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form id="fishForm" enctype="multipart/form-data" method="POST"
                                                            action="{{ route('admin.product.update' , $item->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="id" id="p_id"
                                                                value="{{ $item->id }}">
                                                            <div class="form-group">
                                                                <label for="name">Nama</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    id="name" required value="{{ $item->nama }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="species">Deskripsi</label>
                                                                <textarea name="deskripsi" class="form-control"
                                                                    id="species" cols="30"
                                                                    rows="2">{{ $item->deskripsi }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Stock">Stock</label>
                                                                <input type="number" class="form-control" name="stock"
                                                                    id="Stock" inputmode="numeric" required step="0.01"
                                                                    value="{{ $item->stock }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Stock">Minimal Order</label>
                                                                <input type="number" class="form-control" name="min_order"
                                                                    id="Stock" inputmode="numeric" required step="0.01"
                                                                    value="{{ $item->min_order }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Harga">Harga</label>
                                                                <input type="number" class="form-control" name="harga"
                                                                    id="Harga" required step="0.01"
                                                                    value="{{ $item->harga }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">Image</label><br>
                                                                <img src="{{ asset( $item->gambar) }}" alt=""
                                                                    style="max-width: 80px; height: auto;">
                                                                <input type="file" class="form-control" name="image"
                                                                    id="image" accept="image/*">
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-outline-primary"
                                                                data-dismiss="modal">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <form action="{{ route('admin.delete.ongkir', encrypt($item->id)) }}"
                                            method="POST" class="d-inline delete-form" style="display: none">
                                            @csrf
                                            <input type="hidden" name="id" id="p_id" value="{{ $item->id }}">
                                            <button class="btn btn-sm btn-danger delete" type="button"
                                                onclick="confirmDelete(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table><hr>
                        <form class="row g-3" action="{{ route('admin.add.ongkir') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 mb-2">
                                <label for="jenis" class="form-label">Jenis</label>
                                <select class="form-control" name="jenis"  id="jenis">
                                    <option value="cod">COD</option>
                                    <option value="transfer">Transfer Bank</option>
                                </select>

                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="inputPassword4" class="form-label">Ongkir</label>
                                <input type="number" name="ongkir" class="form-control" id="inputPassword4">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-danger" href="javascript:history.back()">Cancel</a>
                            </div>
                        </form>
                        {{-- @endforelse --}}
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
    <!---Container Fluid-->
    {{--
</div> --}}

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
