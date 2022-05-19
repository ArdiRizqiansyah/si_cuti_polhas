<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PegawaiUnit;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Pegawai::with(['user', 'unit'])->find(auth()->user()->pegawai->id);

        $data =[
            'profile' => $profile,
            'units' => Unit::all(),
        ];

        return view('pegawai.profile.index', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'nrp' => 'required',
            'email' => 'required|email',
            'jabatan' => 'required',
            'unit_id' => 'required',
        ]);

        // data user
        $data_user = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            // 'role_id' => 3,
        ];
        
        // cek password
        if ($request->password) {
            // enskripsi password
            $data_user['password'] = Hash::make($request->password);
        }

        // update data ke user
        $user = User::find($id);
        $user->update($data_user);

        // data pegawai
        $data_pegawai = [
            'user_id' => $user->id,
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'unit_id' => $request->unit_id,
            'tgl_kontak_pkwt_1' => $request->tgl_pkwt_1 ?? null,
            'tgl_kontak_pkwt_2' => $request->tgl_pkwt_2 ?? null,
            'tgl_sk_tetap' => $request->tgl_sk ?? null,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jk,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_nikah,
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'no_kk' => $request->kk,
            'jumlah_anak' => $request->jum_anak,
            'pendidikan_terakhir' => $request->pen_akhir,
            'gelar' => $request->gelar,
            'no_wa' => $request->wa,
            'nama_ibu_kandung' => $request->ibu_kan,
            'nama_ayah_kandung' => $request->ayah_kan,
            'nama_ibu_mertua' => $request->ibu_mer,
            'nama_ayah_mertua' => $request->ayah_mer,
            'jenjang_kepangkatan' => $request->jen_pangkat,
            'npwp' => $request->npwp,
            'nidn' => $request->nidn,
            'bpjs_ketenagakerjaan' => $request->bpjs_ket,
            'bpjs_kesehatan' => $request->bpjs_kes,
            'dokter_paskes_tingkat_1' => $request->dok_1,
            'bank' => $request->bank,
            'an' => $request->an,
            'no_rekening' => $request->no_rek,
        ];

        $pegawai = Pegawai::where('user_id', $user->id)->first();

        // update data ke pegawai
        $pegawai->update($data_pegawai);

        // cek perubahan unit
        if($request->unit_id != $pegawai->pegawaiUnit->unit_id) {
            // update pegawai ke tabel pegawai_unit
            $pegawai_unit = PegawaiUnit::where('pegawai_id', $pegawai->id)->first();
            $pegawai_unit->update([
                'unit_id' => $request->unit_id,
            ]);
        }

        return redirect()->route('pegawai.profile', $pegawai->id)->with('success', 'Data berhasil diubah');
    }
}
