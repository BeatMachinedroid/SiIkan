@extends('layout.app')

@section('content')

{{-- <div id="content"> --}}


    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                id="#modalCenter">Add Data</button>
            <h1 class="h3 mb-0 text-gray-800 text-gradient">Data Categories</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Categories</li>
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
                                    <th style="background-color: #6777f0; color: white;">Gambar</th>
                                    <th style="background-color: #6777f0; color: white;">Kategori</th>
                                    <th style="background-color: #6777f0; color: white; ">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($categories as $no=> $item)
                                <tr class="text-capitalize">
                                    <td>{{ $no+1 }}</td>
                                    <td><img src="{{ asset( $item->gambar) }}" alt=""
                                            style="max-width: 100px; height: auto;"></td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning me-1" data-toggle="modal"
                                            data-target="#exampleModalCenterUpdate{{ $item->id }}" id="#modalCenter"><i
                                                class="fas fa-edit"></i>
                                        </a>

                                        <!-- Modal update -->
                                        <div class="modal fade" id="exampleModalCenterUpdate{{ $item->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form id="fishForm" enctype="multipart/form-data" method="POST"
                                                            action="{{ route('admin.categories.update' , encrypt($item->id)) }}">
                                                            @csrf
                                                            <div class="form-group text-center">
                                                                <img src="{{ asset( $item->gambar) }}" alt=""
                                                                    style="max-width: 200px; height: auto;">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama">Categories</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    id="nama" required step="0.01"
                                                                    value="{{ $item->nama }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">Image</label>
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
                                        </div>

                                        <form action="{{ route('admin.categories.delete', encrypt($item->id)) }}"
                                            method="POST" class="d-inline delete-form" style="display: none">
                                            @csrf
                                            <input type="hidden" name="id" id="p_id" value="">
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
                        </table>

                        {{-- @endforelse --}}
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->

    </div>
    <!---Container Fluid-->
    {{--
</div> --}}
<!-- Modal create -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            <div class="modal-body">
                <form id="fishForm" enctype="multipart/form-data" method="POST"
                    action="{{ route('admin.create.categories') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Categories</label>
                        <input type="text" class="form-control" name="nama" id="nama" required step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
