<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Ongkir;
use App\Models\Pembelian;
use App\Models\Pembayaran;
use App\Models\Toko;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $toko = Toko::all();

        return view('checkout', compact('cart', 'cart_count', 'total', 'toko'));
    }

    public function store(Request $request)
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });

        $validator = Validator::make($request->all(), [
            'total' => 'required|numeric',
            'alamat' => 'required',
            'kota' => 'required',
            'no_telp' => 'required',
            'payment'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors()->first())->with('icon', 'error');
        }


        $date = Carbon::now()->format('dmy');
        $orderCount = Pembelian::with('ikan')->with('user')->whereDate('created_at', Carbon::now())->orderBy('id', 'desc')->count() + 1;
        $kode = "OR-" . $date . "-" . str_pad($orderCount, 5, '0', STR_PAD_LEFT);
        $cart = Cart::where('user_id', Auth::id())->get();
        $ongkir = Ongkir::where('jenis', $request->payment)->first();
        if ($request->payment == 'transfer') {
            $newDate = Carbon::now()->addDays(3);
            $status = 'Tertunda';
            $ongkir = $ongkir->ongkir;
        } else {
            $newDate = Carbon::now();
            $status = 'Pembayaran Ditempat (COD)';
            $ongkir = $ongkir->ongkir;
        }

        foreach ($cart as $item) {
            $order = Pembelian::create([
                'id_user' => Auth::id(),
                'id_ikan' => $item->product_id,
                'kode_order' => $kode,
                'jumlah' => $item->quantity,
                'total_harga' => $item->total,
                'alamat' => $request->alamat.'  kota : '. $request->kota,
                'no_telpon' => $request->no_telp,
                'ongkir' => $ongkir,
                'metode_pembayaran' => $request->payment,
                'batas_pembayaran' => $newDate,
                'status_order' => 'Diproses',
                'status_pembayaran' => $status
            ]);
        }

        if ($order) {
            Pembayaran::create([
                'kode_order' => $kode,
                'bukti_pembayaran' => '',
                'tanggal_order' => $newDate,
                'tanggal_pembayaran' => '',
                'status' => $status,
            ]);
            $hapus = Cart::where('user_id', auth()->id())->delete();
        }

        if ($hapus) {
            return redirect()->route('welcome')->with('message', 'Checkout berhasil')->with('icon', 'success');
        } else {
            return back()->with('message', 'Checkout gagal')->with('icon', 'error');
        }
    }
}
