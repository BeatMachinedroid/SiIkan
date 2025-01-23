<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ikan;
use App\Models\Ongkir;
use App\Models\Pembelian;
use App\Models\Toko;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Validated;

class DashboardControllers extends Controller
{

    public function index()
    {
        $earning = Pembelian::selectRaw(
            'SUM(total_harga) as total,
            max(ongkir) as ongkir,
            MONTH(created_at) as month,
            YEAR(created_at) as year,
            sum(jumlah) as banyak_terjual'
        )->where('status_pembayaran', 'selesai')->groupBy('month', 'year')
            ->get();
        $newuser = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $pendingreq = Pembelian::selectRaw(
            'count(kode_order) as pending_request,
            MONTH(created_at) as month,
            YEAR(created_at) as year'
        )
            ->where('status_pembayaran', 'Tertunda') // Correctly using where method
            ->groupBy('month', 'year')
            ->get();

        return view('admin.dashboard', compact('earning', 'newuser', 'pendingreq'));
    }

    public function User_page()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }


    // Setting Logo

    public function toko()
    {
        $setting_toko = Toko::all();
        return view('admin.setting.setting', compact('setting_toko'));
    }

    public function add_setting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_toko' => 'required',
            'address' => 'required',
            'deskripsi' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'no_telp_toko' => 'required',
            'email_toko' => 'required|email',
            'gambar' => 'required|mimes:jpg,jpeg,png,gif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors()->first())->with('icon', 'error');
        }

        $imageName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images/gambar toko'), $imageName);
        $image_url = 'images/gambar toko/' . $imageName;
        $setting = Toko::create([
            'nama_toko' => $request->nama_toko,
            'alamat_toko' => $request->address,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'no_telp_toko' => $request->no_telp_toko,
            'email_toko' => $request->email_toko,
            'gambar' => $image_url,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($setting) {
            return redirect()->back()->with('message', 'Setting Toko Berhasil Diubah')->with('icon', 'success');
        } else {
            return redirect()->back()->with('message', 'Setting Toko Gagal Diubah')->with('icon', 'error');
        }
    }

    public function update_toko(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_toko' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'no_telp_toko' => 'required',
            'email_toko' => 'required|email',
            'gambar' => 'nullable|mimes:jpg,jpeg,png,gif',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors()->first())->with('icon', 'error');
        }

        $toko = Toko::find(decrypt($id));
        if ($request->has('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/gambar toko'), $imageName);
            $image_url = 'images/gambar toko/' . $imageName;
            $toko->update([
                'nama_toko' => $request->nama_toko,
                'alamat_toko' => $request->address,
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'no_telp_toko' => $request->no_telp_toko,
                'email_toko' => $request->email_toko,
                'gambar' => $image_url,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        $toko->update([
            'nama_toko' => $request->nama_toko,
            'alamat_toko' => $request->address,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'no_telp_toko' => $request->no_telp_toko,
            'email_toko' => $request->email_toko,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($toko) {
            return redirect()->back()->with('message', 'Setting Toko Berhasil Diubah')->with('icon', 'success');
        } else {
            return redirect()->back()->with('message', 'Setting Toko Gagal Diubah')->with('icon', 'error');
        }
    }

    public function setting_ongkir()
    {
        $ongkir = Ongkir::all();
        return view('admin.setting.ongkir', compact('ongkir'));
    }

    public function add_ongkir(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ongkir' => 'required|numeric',
            'jenis' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors()->first())->with('icon', 'error');
        }

        $ongkir = Ongkir::create([
            'ongkir' => $request->ongkir,
            'jenis' => $request->jenis,
        ]);

        if ($ongkir) {
            return redirect()->back()->with('message', 'Ongkir Berhasil Ditambahkan')->with('icon', 'success');
        } else {
            return redirect()->back()->with('message', 'Ongkir Gagal Ditambahkan')->with('icon', 'error');
        }
    }

    public function delete_ongkir($id)
    {
        $ongkir = Ongkir::find(decrypt($id));
        if ($ongkir->delete()) {
            return redirect()->back()->with('message', 'Ongkir Berhasil Dihapus')->with('icon', 'success');
        } else {
            return redirect()->back()->with('message', 'Ongkir Gagal Dihapus')->with('icon', 'error');
        }
    }
}
