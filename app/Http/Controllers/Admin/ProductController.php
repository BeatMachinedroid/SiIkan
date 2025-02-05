<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Ikan::with('categories')->get();
        $categories = Category::all();
        return view('admin.product', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'category' => 'required',
            'deskripsi' => 'required|text:255',
            'stock' => 'required|numeric',
            'min_order' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->with('message', $validator->errors()->first())->with('icon', 'error');
        // }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/product/'), $imageName);
        $image_url = 'images/product/' . $imageName;
        $product = Ikan::create([
            'nama' => $request->nama,
            'id_cate' => $request->category,
            'deskripsi' => $request->deskripsi,
            'stock' => $request->stock,
            'min_pembelian' => $request->min_order,
            'harga' => $request->harga,
            'gambar' => $image_url,
        ]);
        if ($product) {
            return redirect()->route('admin.product')->with('message', 'Product added successfully')->with('icon', 'success');
        } else {
            return redirect()->route('admin.product')->with('message', 'Failed to add product')->with('icon', 'error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'category' => 'required',
            'deskripsi' => 'required',
            'stock' => 'required|numeric',
            'min_order' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors()->first())->with('icon', 'error');
        }

        $product = Ikan::find(decrypt($id));

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/product/'), $imageName);
            $image_url = 'images/product/' . $imageName;
        } else {
            $image_url = $product->gambar;
        }

        // return $request;
        $product->update([
            'nama' => $request->nama,
            'id_cate' => $request->category,
            'deskripsi' => $request->deskripsi,
            'stock' => $request->stock,
            'min_pembelian' => $request->min_order,
            'harga' => $request->harga,
            'gambar' => $image_url,
        ]);


        if ($product) {
            return redirect()->route('admin.product')->with('message', 'Product updated successfully')->with('icon', 'success');
        } else {
            return redirect()->route('admin.product')->with('message', 'Failed to update product')->with('icon', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ikan = Ikan::find(decrypt($id));
        $ikan->delete();
        if ($ikan) {
            return redirect()->route('admin.product')->with('message', 'Product deleted successfully')->with('icon', 'success');
        } else {
            return redirect()->route('admin.product')->with('message', 'Failed to delete product')->with('icon', 'error');
        }
    }
}
