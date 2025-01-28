<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ikan;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Pembelian;
use App\Models\Toko;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function product_search(Request $request)
    {
        $categories = Category::withCount('ikan')->get();
        $search = $request->search;
        $products = Ikan::where('nama', 'like', '%' . $search . '%')->paginate(15);
        $cart = Cart::where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $toko = Toko::all();
        $top_sell = Pembelian::select('id_ikan', DB::raw('COUNT(*) as total_sales')) // Count the number of purchases
        ->with('ikan') // Eager load the related Ikan model
        ->groupBy('id_ikan') // Group by the product ID
        ->orderBy('total_sales', 'desc') // Order by total sales in descending order
        ->take(10) // Limit to top 10 products
        ->get();
        return view('products', compact('products', 'cart', 'cart_count', 'total', 'toko','categories','top_sell'));
    }

    public function search($search)
    {
        $categories = Category::withCount('ikan')->get();
        $products = Ikan::where('nama', 'like', '%' . $search . '%')->paginate(15);
        $cart = Cart::where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $toko = Toko::all();
        $top_sell = Pembelian::select('id_ikan', DB::raw('COUNT(*) as total_sales')) // Count the number of purchases
        ->with('ikan') // Eager load the related Ikan model
        ->groupBy('id_ikan') // Group by the product ID
        ->orderBy('total_sales', 'desc') // Order by total sales in descending order
        ->take(10) // Limit to top 10 products
        ->get();
        return view('products', compact('products', 'cart', 'cart_count', 'total', 'toko','categories','top_sell'));
    }
}
