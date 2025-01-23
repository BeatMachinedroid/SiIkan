<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ikan;
use App\Models\Pembelian;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting_logo;
use App\Models\Toko;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // home
        $products = Ikan::all();
        $toko = Toko::all();
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        // return $toko;

        return view('welcome', compact('products', 'cart', 'cart_count', 'total', 'toko'));
    }

    public function show()
    {
        $products = Ikan::paginate(15);
        $cart = Cart::where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $toko = Toko::all();

        return view('products', compact('products', 'cart', 'cart_count', 'total', 'toko'));
    }

    public function buy(Request $request)
    {
        $product = Ikan::find($request->id);
        $user = Auth::user();
        $total = $product->harga * $request->jumlah;
        $pembelian = new Pembelian();
        $pembelian->user_id = $user->id;
        $pembelian->ikan_id = $product->id;
        $pembelian->jumlah = $request->jumlah;
        $pembelian->total = $total;
        $pembelian->save();
        return redirect()->route('product.show');
    }

    public function detail_product($id)
    {
        $product = Ikan::find(decrypt($id));
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $itemqty = Ikan::where('id', decrypt($id))->first();
        $min_order = $itemqty->min_pembelian;
        $toko = Toko::all();

        return view('detail_product', compact('product', 'cart', 'cart_count', 'total', 'min_order', 'toko'));
    }
}
