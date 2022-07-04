<?php

namespace App\Http\Controllers\Direktur;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = User::with(['role'])->find(auth()->user()->id);

        $data =[
            'profile' => $profile,
        ];

        return view('direktur.profile.index', $data);
    }

    public function update(Request $request)
    {
        // cari user
        $user = User::find(auth()->user()->id);

        $rules = [];

        // validasi data pegawai jika inputan ada
        if ($request->password) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        if($request->has('avatar')) {
            $rules['avatar'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        if($request->username && $request->username != $user->username) {
            $rules['username'] = 'required|unique:users,username,'.$user->id;
        }

        if($request->email && $request->email != $user->email) {
            $rules['email'] = 'required|unique:users,email,'.$user->id;
        }

        // lakukan validasi
        $request->validate($rules);

        // data user
        $data_user = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        // cek password
        if($request->password != null) {
            // enskripsi password
            $data_user['password'] = Hash::make($request->password);
        }

        // cek avatar
        if ($request->file('avatar')) {
            $image = $request->file('avatar');
            $image->storeAs('public/avatar', $image->hashName());
            $data_user['avatar'] = $image->hashName();
        }

        // hapus avatar lama
        if ($user->avatar) {
            Storage::delete('public/avatar/' . $user->avatar);
        }

        // update data ke user
        $user->update($data_user);

        return back()->with('success', 'Data berhasil diubah');
    }
}
