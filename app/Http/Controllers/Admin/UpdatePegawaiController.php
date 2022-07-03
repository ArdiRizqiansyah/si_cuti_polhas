<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdatePegawaiController extends Controller
{
    public function pribadi($id)
    {
        $profile = Pegawai::with(['user', 'unit'])->find($id);

        $data =[
            'profile' => $profile,
        ];

        return view('admin.pegawai.edit.pribadi', $data);
    }

    public function keluarga($id)
    {
        $profile = Pegawai::with(['user', 'unit'])->find($id);

        $data =[
            'profile' => $profile,
        ];

        return view('admin.pegawai.edit.keluarga', $data);
    }

    public function akun($id)
    {
        $profile = Pegawai::with(['user', 'unit'])->find($id);

        $data =[
            'profile' => $profile,
        ];

        return view('admin.pegawai.edit.akun', $data);
    }

    public function pegawai($id)
    {
        $profile = Pegawai::with(['user', 'unit'])->find($id);

        $data =[
            'profile' => $profile,
            'units' => Unit::all(),
        ];

        return view('admin.pegawai.edit.pegawai', $data);
    }

    public function updatePribadi($id, Request $request)
    {
        // cari pegawai
        $pegawai = Pegawai::find($id);

        $data_user = [
            'nama' => $request->nama,
        ];

        // cari user
        $user = User::find($pegawai->user_id);

        // update data user
        $user->update($data_user);

        $data_pegawai = [
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jk,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_nikah,
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'pendidikan_terakhir' => $request->pen_akhir,
            'gelar' => $request->gelar,
            'no_wa' => $request->wa,
            'no_bpjs_ketenagakerjaan' => $request->bpjs_ket,
            'no_bpjs_kesehatan' => $request->bpjs_kes,
            'dokter_paskes_tingkat_1' => $request->dok_1,
            'bank' => $request->bank,
            'an' => $request->an,
            'no_rekening' => $request->norek,
        ];

        // update data pegawai
        $pegawai->update($data_pegawai);

        return back()->with('success', 'Data berhasil diubah');
    }

    public function updateKeluarga($id, Request $request)
    {
        // cari pegawai
        $pegawai = Pegawai::find($id);

        // data pegawai
        $data_pegawai = [
            'no_kk' => $request->kk,
            'nama_ibu_kandung' => $request->ibu_kan,
            'nama_ayah_kandung' => $request->ayah_kan,
            'nama_ibu_mertua' => $request->ibu_mer,
            'nama_ayah_mertua' => $request->ayah_mer,
            'jumlah_anak' => $request->jum_anak,
        ];

        // update data ke pegawai
        $pegawai->update($data_pegawai);

        return back()->with('success', 'Data berhasil diubah');
    }

    public function updateAkun($id, Request $request)
    {
        // cari pegawai
        $pegawai = Pegawai::find($id);

        // cari user
        $user = User::find($pegawai->user_id);

        $rules = [];

        // validasi data pegawai jika inputan ada
        if ($request->password) {
            $rules['password'] = 'required|min:6';
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

        // update data ke user
        $user->update($data_user);

        return back()->with('success', 'Data berhasil diubah');
    }

    public function updatePegawai($id, Request $request)
    {
        // cari pegawai
        $pegawai = Pegawai::find($id);

        // data pegawai
        $data_pegawai = [
            'jenjang_kepangkatan' => $request->jen_pangkat,
            'npwp' => $request->npwp,
            'nidn' => $request->nidn,
            'nrp'  => $request->nrp,
            'jabatan' => $request->jabatan,
            'unit_id' => $request->unit_id,
            'tgl_kontrak_pkwt_1' => $request->tgl_pkwt_1,
            'tgl_kontrak_pkwt_2' => $request->tgl_pkwt_2,
            'tgl_sk_tetap' => $request->tgl_sk,
        ];

        // update data ke pegawai
        $pegawai->update($data_pegawai);

        return back()->with('success', 'Data berhasil diubah');
    }
}
