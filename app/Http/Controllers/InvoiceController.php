<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function show($kode_order)
    {
        // Cari order berdasarkan kode_order
        $order = Pembelian::with('user','ikan')->where('kode_order', $kode_order)->get();
        $invoice = Pembelian::with('user','ikan')->where('kode_order', $kode_order)->firstOrFail();
        $totalSemuaInvoice = $order->sum('total_harga');

        // return view('invoice.show', compact('order','invoice','totalSemuaInvoice'));

        // Opsi untuk generate PDF
        $pdf = FacadePdf::loadView('invoice.show', compact('order','invoice','totalSemuaInvoice'));
        return $pdf->download('invoice-' . $kode_order . '.pdf');
    }
}
