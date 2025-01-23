<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Ikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $cart_count = Cart::where('user_id', Auth::id())->count();
        return view('cart', compact('cart', 'cart_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('message', $validator->errors()->first())->with('icon', 'error');
        }

        $product = Ikan::find(decrypt($request->product_id));
        $item_exist = Cart::where('product_id', $product->id)->where('user_id', Auth::id())->first();

        if ($item_exist) {
            $item_exist->quantity += $product->min_pembelian;
            $item_exist->total += $product->harga;
            $item_exist->save();
            return back()->with('message', 'Product added to cart successfully')->with('icon', 'success');
        } else {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $product->min_pembelian,
                'total' => $product->harga,
            ]);

            if ($cart) {
                return back()->with('message', 'Product added to cart successfully')->with('icon', 'success');
            } else {
                return back()->with('message', 'Failed to add product to cart')->with('icon', 'error');
            }

        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required',
        ]);


        if ($validator->fails()) {
            return back()->with('message', $validator->errors()->first())->with('icon', 'error');
        }

        $product = Ikan::find(decrypt($request->product_id));
        $item_exist = Cart::where('product_id', $product->id)->where('user_id', Auth::id())->first();

        if ($item_exist) {
            $item_exist->quantity += $request->quantity;
            $item_exist->total += $product->harga * $request->quantity;
            $item_exist->save();
            return back()->with('message', 'Product added to cart successfully')->with('icon', 'success');
        } else {
            if($product->min_pembelian > $request->quantity){
                return back()->with('message', 'Failed to add product to cart, quantity exceeds stock')->with('icon', 'error');
            }if($product->stock == 0){
                return back()->with('message', 'Failed to add product to cart, out of stock')->with('icon', 'error');
            } else {
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'total' => $product->harga * $request->quantity,
                ]);

                if ($cart) {
                    return back()->with('message', 'Product added to cart successfully')->with('icon', 'success');
                } else {
                    return back()->with('message', 'Failed to add product to cart')->with('icon', 'error');
                }
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::find(decrypt($id));
        $cart->delete();
        if($cart){
            return back()->with('message', 'Product deleted successfully')->with('icon', 'success');
        } else {
            return back()->with('message', 'Failed to delete product')->with('icon', 'error');
        }
    }

    public function deleteAll()
    {
        $cart = Cart::where('user_id', Auth::id())->delete();
        if($cart){
            return back()->with('message', 'All products deleted successfully')->with('icon', 'success');
        } else {
            return back()->with('message', 'Failed to delete products')->with('icon', 'error');
        }
    }
}
