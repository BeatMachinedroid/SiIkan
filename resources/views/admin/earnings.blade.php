@extends('layout.app')

@section('content')

{{-- <div id="content"> --}}


    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800 text-gradient">Banyak Ikan terjual per - Users</h1>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">report data</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group" id="simple-date4">
                            <form action="{{ route('admin.earnings.report.search') }}" method="POST">
                                @csrf
                                <div class="input-daterange input-group">
                                    <input type="text" class="input-sm form-control" name="start"  />
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">to</span>
                                    </div>
                                    <input type="text" class="input-sm form-control" name="end" />
                                    <button class="btn btn-primary" type="submit" id="button-addon2">Button</button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush fs-6" id="dataTables" data-page-length='10'>
                                <thead class="thead-light">
                                    <tr>
                                        <th style="background-color: #6777f0; color: white;">No</th>
                                        <th style="background-color: #6777f0; color: white;">Nama</th>
                                        <th style="background-color: #6777f0; color: white;">Alamat</th>
                                        <th style="background-color: #6777f0; color: white;">Ikan</th>
                                        <th style="background-color: #6777f0; color: white;">jumlah</th>
                                        <th style="background-color: #6777f0; color: white;">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($earnings as $no => $item)
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->ikan->nama }}</td>
                                        <td>{{ $item->jumlah_beli }}Kg</td>
                                        <td>Rp.{{ $item->total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
