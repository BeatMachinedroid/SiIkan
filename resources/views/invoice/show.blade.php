<!DOCTYPE html>
<html>

<head>
    <title>Invoice - {{ $invoice->kode_order }}</title>
    <style>
        /* Styling CSS untuk invoice */
        body {
            font-family: sans-serif;
            font-size: 14px
        }

        /* .container { width: 80%; margin: 0 auto; } */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .biodata td {
            /* padding: 8px; */
            border: none;
            /* No border for biodata table */
            text-align: left;
        }

        /* Styles for the invoice table */
        .invoice th,
        .invoice td {
            /* padding: 8px; */
            border: 1px solid #ddd;
            /* Border for invoice table */
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <hr>
        <h2 class="text-center">INVOICE #{{ $invoice->kode_order }}</h2>
        <hr>
        <table class="biodata">
            <tbody>
                <tr>
                    <td>Tanggal Cetak</td>
                    <td>:</td>
                    <td>{{ now()->format('d F Y H:i') }} </td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>:</td>
                    <td>{{ $invoice->user->name }} </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $invoice->user->address }} </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $invoice->user->email }}</td>
                </tr>
                <tr>
                    <td>Tanggal Order</td>
                    <td>:</td>
                    <td> {{ $invoice->created_at->format('d F Y H:i') }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <br>
        <table class="invoice">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Jumlah Beli</th>
                    <th>Harga Satuan</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $item)
                <tr>
                    <td><img src="{{ public_path($item->ikan->gambar) }}" alt="" style="height: 80px;width: auto"></td>
                    <td>{{ $item->ikan->nama }}</td>
                    <td>{{ $item->jumlah }}Kg</td>
                    <td class="text-right">Rp {{ number_format($item->ikan->harga) }}</td>
                    <td class="text-right">Rp {{ number_format($item->total_harga ) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right">Jumlah Sub Total</td>
                    <td class="text-right">Rp {{ number_format($totalSemuaInvoice) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Ongkir</td>
                    <td class="text-right">Rp {{ number_format($invoice->ongkir ?? 0) }}</td> {{-- Asumsikan ada kolom
                    ongkir di tabel orders --}}
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><b>Total Pembayaran</b></td>
                    <td class="text-right"><b>Rp {{ number_format($totalSemuaInvoice + $invoice->ongkir ?? 0) }}</b>
                    </td>
                </tr>
            </tfoot>
        </table>

        <p>NOTICE:<br>Barang yang sudah dibeli tidak dapat dikembalikan / ditukar, kecuali ada perjanjian tertentu</p>
    </div>
</body>

</html>
