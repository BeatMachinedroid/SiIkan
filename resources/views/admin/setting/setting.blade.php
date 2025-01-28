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
                        @forelse ($setting_toko as $item)
                        <form class="row g-3" action="{{ route('admin.toko.update', encrypt($item->id)) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 mb-2">
                                <label for="inputEmail4" class="form-label">Nama Toko</label>
                                <input type="text" name="nama_toko" class="form-control" id="inputEmail4" value="{{ $item->nama_toko }}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="inputPassword4" class="form-label">Email Toko</label>
                                <input type="email" name="email_toko" class="form-control" id="inputPassword4" value="{{ $item->email_toko }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="Telp" class="form-label">No Telp Toko</label>
                                <input type="text" name="no_telp_toko" class="form-control" id="Telp" value="{{ $item->no_telp_toko }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="Gmaps" class="form-label">Latitude</label>
                                <input type="text" name="lat" class="form-control" id="Gmaps" value="{{ $item->latitude }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="Gmaps" class="form-label">Longitude</label>
                                <input type="text" name="lng" class="form-control" id="Gmaps" value="{{ $item->longitude }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="Gmaps" class="form-label">Gambar toko</label>
                                <input type="file" name="gambar" class="form-control" id="Gmaps" value="">
                            </div>

                            <div class="col-md-8 mb-4">
                                <label for="Address" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control"
                                    id="Address">{{ $item->deskripsi }}</textarea>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="gambartoko" class="form-label">Gambar toko</label>
                                <img src="{{ asset($item->gambar) }}" alt="" style="height: auto; width: 300px" id="gambartoko">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="Address" class="form-label">Address</label>
                                <textarea name="address" id="" cols="30" rows="5" class="form-control"
                                    id="Address">{{ $item->alamat_toko }}</textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-danger" href="javascript:history.back()">Cancel</a>
                            </div>
                        </form>
                        @empty
                        <form class="row g-3" action="{{ route('admin.toko.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 mb-2">
                                <label for="inputEmail4" class="form-label">Nama Toko</label>
                                <input type="text" name="nama_toko" class="form-control" id="inputEmail4">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="inputPassword4" class="form-label">Email Toko</label>
                                <input type="email" name="email_toko" class="form-control" id="inputPassword4">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="Telp" class="form-label">No Telp Toko</label>
                                <input type="text" name="no_telp_toko" class="form-control" id="Telp">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="Gmaps" class="form-label">Latitude</label>
                                <input type="text" name="lat" class="form-control" id="Gmaps">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="Gmaps" class="form-label">longitude</label>
                                <input type="text" name="lng" class="form-control" id="Gmaps">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="Gmaps" class="form-label">Gambar toko</label>
                                <input type="file" name="gambar" class="form-control" id="Gmaps" value="">
                            </div>

                            <div class="col-md-8 mb-4">
                                <label for="Address" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control"
                                    id="Address"></textarea>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img src="" alt="">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="Address" class="form-label">Address</label>
                                <textarea name="address" id="" cols="30" rows="5" class="form-control"
                                    id="Address"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-danger" href="javascript:history.back()">Cancel</a>
                            </div>
                        </form>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->

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
