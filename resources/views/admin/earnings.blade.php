@extends('layout.app')

@section('content')
<style>
    @media print {

        /* Sembunyikan elemen yang tidak ingin dicetak */
        .no-print {
            display: none;
        }
    }
</style>
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
                    <div class="card-body row">
                        <div class="col-md-11 form-group no-print" id="simple-date4">
                            <form action="{{ route('admin.earnings.report.search') }}" method="POST">
                                @csrf
                                <div class="input-daterange input-group">
                                    <input type="text" class="input-sm form-control" name="start" />
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">to</span>
                                    </div>
                                    <input type="text" class="input-sm form-control" name="end" />
                                    <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1 no-print">
                            <button class="btn btn-primary text-white" type="submit" id="button-addon2"><i
                                    class="fas fa-print" onclick="printPage()"> Print</i></button>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush fs-6" id="dataTables"
                                data-page-length='10'>
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
                                        <td>Rp.{{ number_format($item->total, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="background-color: #6777f0; color: white;">TOTAL :</th>
                                        <th style="background-color: #6777f0; color: white;">Rp.{{
                                            number_format($totalgrand, 0, ',', '.') }}</th>
                                </tfoot>
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

<script>
    $(document).ready(function() {
        $('#dataTables').DataTable(); // Inisialisasi DataTables
    });

    function printPage() {
        // Ambil semua data dari DataTables
        var table = $('#dataTables').DataTable();
        var data = table.rows().data();

        // Buka jendela baru
        var printWindow = window.open();
        var total = 0; // Inisialisasi total

        // Tulis konten ke jendela baru
        printWindow.document.write('<html><head><title>Cetak Data</title>');
        printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; text-align: center; } th { background-color: #f2f2f2; }</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h2>Data Tabel</h2>');
        printWindow.document.write('<table><thead><tr><th>ID</th><th>Nama</th><th>Harga</th><th>Jumlah</th></tr></thead><tbody>');

        // Loop melalui data dan tambahkan ke tabel
        for (var i = 0; i < data.length; i++) {
            var subtotal = parseInt(data[i][5]);
            total += subtotal; // Tambahkan ke total

            printWindow.document.write('<tr>');
            printWindow.document.write('<td>' + data[i][0] + '</td>'); // ID
            printWindow.document.write('<td>' + data[i][1] + '</td>'); // Nama
            printWindow.document.write('<td>' + data[i][2] + '</td>'); // Alamat
            printWindow.document.write('<td>' + data[i][3] + '</td>'); // Ikan
            printWindow.document.write('<td>' + data[i][4] + '</td>'); // jumlah
            printWindow.document.write('<td>' + data[i][5] + '</td>'); // Total
            printWindow.document.write('</tr>');
        }
        printWindow.document.write('</tbody>');

        // Menambahkan footer dengan total
        printWindow.document.write('<tfoot>');
        printWindow.document.write('<tr><th colspan="5">TOTAL:</th><th>Rp.' + total + '</th></tr>');
        printWindow.document.write('</tfoot>');

        printWindow.document.write('</table>');
        printWindow.document.write('</body></html>');

        // Selesaikan penulisan dokumen
        printWindow.document.close();

        // Memicu dialog cetak
        printWindow.print();

        // Menutup jendela setelah mencetak
        printWindow.close();
    }
</script>

@endsection