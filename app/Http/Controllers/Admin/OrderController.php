<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data_order = Pembelian::selectRaw(
            'kode_order,
            MAX(name) AS name,
            MAX(status_order) AS status_order,
            MAX(status_pembayaran) AS status_pembayaran,
            SUM(total_harga) AS total,
            DATE_FORMAT(MAX(pembelians.created_at), "%d-%m-%Y %H:%i:%s") AS tgl_order,
            MAX(pembelians.id) AS last_id')
        ->join('users', 'pembelians.id_user', '=', 'users.id')
        ->groupBy('kode_order')
        ->get();
        return view('admin.order' , compact('data_order'));
    }

    public function detail($kode)
    {
        $data_order = Pembelian::with('ikan')->with('user')->where('kode_order', $kode)->get();
        $order = Pembelian::selectRaw(
            'kode_order,
            MAX(name) AS name,
            MAX(no_telpon) as no_telp,
            MAX(alamat) as alamat,
            count(pembelians.id) As jumlah_item,
            MAX(status_order) AS status_order,
            MAX(status_pembayaran) AS status_pembayaran,
            MAX(metode_pembayaran) As metode,
            MAX(ongkir) AS ongkir,
            SUM(total_harga) AS total,
            DATE_FORMAT(MAX(pembelians.created_at), "%d %M %Y %H:%i:%s") AS tgl_order,
            MAX(pembelians.id) AS last_id')
        ->where('kode_order', $kode)
        ->join('ikans', 'pembelians.id_ikan', '=', 'ikans.id') // Bergabung dengan tabel ikans
        ->join('users', 'pembelians.id_user', '=', 'users.id') // Bergabung dengan tabel users
        ->groupBy('kode_order')
        ->get();
        $pembayaran = Pembayaran::where('kode_order', $kode)->get();
        return view('admin.detail_order', compact('data_order', 'order','pembayaran'));
    }

    public function konfirmasi($id){

        $data_bayar = Pembayaran::where('kode_order' , $id)->update([
            'status' => 'pengiriman'
        ]);

        $data_order = Pembelian::where('kode_order' , $id)->update([
            'status_pembayaran' => 'Selesai'
        ]);

        if($data_bayar && $data_order){
            return redirect()->back()->with('message', 'Pembayaran Terkonfirmasi')->with('icon','success');
        }
    }

    public function gagalkan($id){
        $data_bayar = Pembayaran::where('kode_order' , $id)->update([
            'status' => 'Gagal'
        ]);

        $data_order = Pembelian::where('kode_order' , $id)->update([
            'status_pembayaran' => 'Gagal'
        ]);

        if($data_bayar && $data_order){
            return redirect()->back()->with('message', 'Pembayaran Terkonfirmasi')->with('icon','success');
        }
    }


}
