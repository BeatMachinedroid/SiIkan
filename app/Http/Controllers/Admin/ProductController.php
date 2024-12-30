<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ikan;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Ikan::all();
        return view('admin.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        $request->validate([
            'nama_ikan' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'required',
        ]);

        $gambar = $request->file('gambar');
        $namaFile = time() . '.' . $gambar->extension();
        $gambar->move(public_path('img'), $namaFile);
        $gambar = $namaFile;
        
        Ikan::create([
            'nama_ikan' => $request->nama_ikan,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambar,
        ]);

        return redirect()->route('admin.product')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ikan $ikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ikan $ikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ikan $ikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ikan $ikan)
    {
        //
    }
}
