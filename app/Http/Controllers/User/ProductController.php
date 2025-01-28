<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ikan;
use App\Models\Pembelian;
use App\Models\cart;
use App\Models\Category;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting_logo;
use App\Models\Toko;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // home
        $products = Ikan::where('created_at', '>=', Carbon::now()->subMonth())->get();
        $top_sell = Pembelian::select('id_ikan', DB::raw('COUNT(*) as total_sales')) // Count the number of purchases
            ->with('ikan') // Eager load the related Ikan model
            ->groupBy('id_ikan') // Group by the product ID
            ->orderBy('total_sales', 'desc') // Order by total sales in descending order
            ->take(10) // Limit to top 10 products
            ->get();
        $categories = Category::all();
        $toko = Toko::all();
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        // return $top_sell;
        return view('welcome', compact('products', 'cart', 'cart_count', 'total', 'toko', 'categories', 'top_sell'));
    }

    public function show()
    {
        $products = Ikan::with('categories')->paginate(12);
        $categories = Category::withCount('ikan')->get();
        $cart = Cart::where('user_id', Auth::id())->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        $total = collect($cart)->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        $toko = Toko::all();
        $top_sell = Pembelian::select('id_ikan', DB::raw('COUNT(*) as total_sales')) // Count the number of purchases
        ->with('ikan')
        ->groupBy('id_ikan')
        ->orderBy('total_sales', 'desc')
        ->take(10)
        ->get();
        return view('products', compact('products', 'cart', 'cart_count', 'total', 'toko','top_sell','categories'));
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
