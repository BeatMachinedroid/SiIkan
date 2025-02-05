<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Toko;
use App\Models\Ikan;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $toko = Toko::all();
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $pembelian = Pembelian::selectRaw(
            'kode_order,
            MAX(name) AS name,
            MAX(no_telpon) as no_telp,
            MAX(alamat) as alamat,
            count(pembelians.id) As jumlah_item,
            MAX(status_order) AS status_order,
            MAX(status_pembayaran) AS status_pembayaran,
            MAX(metode_pembayaran) As metode,
            SUM(total_harga) AS total,
            DATE_FORMAT(MAX(pembelians.created_at), "%d %M %Y %H:%i:%s") AS tgl_order,
            MAX(pembelians.id) AS last_id'
        )   ->where('id_user','=', Auth::user()->id)
            ->join('ikans', 'pembelians.id_ikan', '=', 'ikans.id') // Bergabung dengan tabel ikans
            ->join('users', 'pembelians.id_user', '=', 'users.id') // Bergabung dengan tabel users
            ->groupBy('kode_order')->orderBy('kode_order', 'desc')
            ->get();

        return view(
            'transaksi',
            compact('cart', 'cart_count', 'total', 'toko', 'pembelian')
        );
    }

    public function detail_transaksi($id)
    {
        $toko = Toko::all();
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $kode = $id;
        $pembelian = Pembelian::with('ikan')->with('user')->where('kode_order', $id)->get();
        $order = Pembelian::selectRaw(
            'kode_order,
            MAX(name) AS name,
            MAX(no_telpon) as no_telp,
            MAX(alamat) as alamat,
            count(pembelians.id) As jumlah_item,
            MAX(status_order) AS status_order,
            MAX(status_pembayaran) AS status_pembayaran,
            MAX(metode_pembayaran) As metode,
            max(ongkir) as ongkir,
            SUM(total_harga) AS total,
            DATE_FORMAT(MAX(pembelians.created_at), "%d %M %Y %H:%i:%s") AS tgl_order,
            DATE_FORMAT(MAX(batas_pembayaran), "%d %M %Y %H:%i:%s") AS batas_bayar,
            MAX(pembelians.id) AS last_id'
        )
            ->where('kode_order', $kode)
            ->join('ikans', 'pembelians.id_ikan', '=', 'ikans.id') // Bergabung dengan tabel ikans
            ->join('users', 'pembelians.id_user', '=', 'users.id') // Bergabung dengan tabel users
            ->groupBy('kode_order')
            ->get();
        $pembayaran = Pembayaran::where('kode_order', $kode)
            ->get();
        return view(
            'detail_transaksi',
            compact('cart', 'cart_count', 'total', 'toko', 'pembelian', 'kode', 'order', 'pembayaran')
        );
    }

    public function upload_bukti(Request $request)
    {
        if ($request->hasFile('bukti')) {
            $validator = Validator::make($request->all(), [
                'kode_order' => 'required',
                'bukti' => 'required|image||mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('message', $validator->errors()->first())->with('icon', 'error');
            }

            $imageName = $request->kode_order . ',' . time() . '.' . $request->bukti->extension();
            $request->bukti->move(public_path('images/bukti_pembayaran'), $imageName);
            $image_url = 'images/bukti_pembayaran/' . $imageName;
            $pembayaran = Pembayaran::where('kode_order', $request->kode_order)->first();
            $pembayaran->update([
                'bukti_pembayaran' => $image_url,
                'tanggal_pembayaran' => Carbon::now(),
                'status' => 'Diproses',
            ]);
            if ($pembayaran) {
                return redirect()->back()->with('message', 'Bukti pembayaran berhasil diupload')->with('icon', 'success');
            } else {
                return redirect()->back()->with('message', 'Bukti pembayaran gagal diupload')->with('icon', 'error');
            }
        }
    }

    public function konfirmasi_barang($id)
    {
        $bayar = pembayaran::where('kode_order', $id)->first();
        if ($bayar->status == 'Pembayaran Ditempat (COD)') {
            $bayar->update([
                'tanggal_pembayaran' => Carbon::now(),
                'status' => 'selesai',
            ]);
        } else {
            $bayar->update([
                'tanggal_pembayaran' => Carbon::now(),
                'status' => 'selesai',
            ]);
        }

        $konfirmasi = Pembelian::where('kode_order', $id)->update([
            'status_order' => 'Selesai'
        ]);

        $pembelian = Pembelian::where('kode_order', $id)->get();

        foreach ($pembelian as $item) {
            // Ambil produk yang dibeli
            $produk = Ikan::find($item->id_ikan);

            if ($produk) {
                // Kurangi stok produk
                $produk->stock -= $item->jumlah;
                $produk->save();
            }
        }


        if ($konfirmasi) {
            return redirect()->back()->with('message', 'Barang berhasil diterima')->with('icon', 'success');
        }
    }
}
