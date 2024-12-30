<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        Session::flash('email',$request->email);
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::Attempt($data)) {
            return redirect()->route('welcome')->with('message', 'Wellcome to SiIkan')->with('icon', 'success');
        }else{
            return redirect()->route('login')->with('message', 'email and password is not valid')->with('icon', 'error');
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Pastikan email unik
            'password' => 'required|string|min:8|confirmed', // Minimal 8 karakter dan harus sama dengan field password_confirmation
            // tambahkan validasi lain sesuai kebutuhan
            'phone' => 'nullable|string|max:20', // Contoh validasi nomor telepon
            'address' => 'nullable|string', // Contoh validasi alamat
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')->with('message', $validator->errors()->first());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'telephone' => $request->phone ?? null, // Simpan jika ada, jika tidak simpan null
            'address' => $request->address ?? null,
        ]);

        if($user){
            return redirect()->route('login')->with('message','Register success, please login')->with('icon', 'success');
        }else{
            return redirect()->route('register')->with('message','Register failed, please try again')->with('icon', 'error');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome')->with('message', 'Logout success')->with('icon', 'success');
    }


    public function ProsesAdminlogin( Request $request)
    {
        Session::flash('email',$request->email);
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed, redirect to the admin dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->with('error', 'Email atau password salah.');
    }



}
