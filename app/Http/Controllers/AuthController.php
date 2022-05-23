<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function post_login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:4|max:255'
        ]);

        if (auth()->attempt($credentials)) {
            if (Auth()->user()->role->name == 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }else if(Auth()->user()->role->name == 'kepala'){
                return redirect()->route('kepala.dashboard');
            }elseif(Auth()->user()->role->name == 'pegawai'){
                return redirect()->route('pegawai.dashboard');
            }
        }

        return redirect()->route('login')->with('failed', 'Username atau Password salah tolong periksa kembali');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
