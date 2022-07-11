<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PegawaiUnit;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'pegawai' => Pegawai::with(['user', 'unit', 'kepala'])->search($request->keyword)->paginate(10),
        ];
        

        return view('admin.pegawai.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'units' => Unit::all(),
        ];
        
        return view('admin.pegawai.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'nrp' => 'required|unique:pegawai',
            'email' => 'required|email|unique:users',
            'jabatan' => 'required',
            'unit_id' => 'required',
        ]);

        // data user
        $data_user = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password ?? 'password123'), // password akan bernilai 'password123' jika $request->password kosong
            'role_id' => 3, // role_id akan bernilai 3 jika pegawai
        ];

        // simpan data ke user
        $user = User::create($data_user);

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
        ];

        // simpan data ke pegawai
        $pegawai = Pegawai::create($data_pegawai);

        return back()->with('success', 'Data pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $data = [
            'pegawai' => $pegawai->load(['user', 'unit']),
            'units' => Unit::all(),
        ];

        return view('admin.pegawai.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
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
            'role_id' => 3, // role_id akan bernilai 3 jika pegawai
        ];
        
        // cek password
        if ($request->password) {
            // enskripsi password
            $data_user['password'] = Hash::make($request->password);
        }

        // update data ke user
        $user = User::find($pegawai->user_id);
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

        // update data ke pegawai
        $pegawai->update($data_pegawai);

        // update pegawai ke tabel pegawai_unit
        // $pegawai_unit = Pegawai::where('id', $pegawai->id)->first();
        // $pegawai_unit->update([
        //     'unit_id' => $request->unit_id,
        // ]);

        return back()->with('success', 'Data pegawai berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        // cek apakah data pegawai dapat dihapus
        if($pegawai->cuti->count() > 0 && $pegawai->izin->count() >0){
            return back()->with('error', 'Data pegawai tidak dapat dihapus karena masih memiliki data cuti dan izin');
        }

        // hapus data user
        $pegawai->user()->delete();

        // hapus data pegawai
        $pegawai->delete();

        return back()->with('success', 'Data pegawai berhasil dihapus');
    }
}
