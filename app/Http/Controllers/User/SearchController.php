<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ikan;
use App\Models\Cart;
use App\Models\Toko;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function product_search(Request $request)
    {
        $search = $request->search;
        $products = Ikan::where('nama', 'like', '%' . $search . '%')->paginate(15);
        $cart = Cart::where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $toko = Toko::all();

        return view('products', compact('products' , 'cart', 'cart_count', 'total', 'toko'));
    }
}
