<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'units' => Unit::with(['pegawai', 'kepala'])->search($request->keyword)->paginate(10),
        ];

        return view('admin.unit.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'units' => Unit::with(['pegawai'])->get(),
            'pegawai' => Pegawai::where('kepala_id', null)->get(),
        ];

        return view('admin.unit.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_unit' => 'required|unique:unit,nama',
            'deskripsi' => 'required',
        ];

        // jika pegawai_id memiliki nilai
        if ($request->pegawai_id != null) {
            $rules['pegawai_id'] = 'required|exists:pegawai,id';
        }else{
            $rules['nama_kepala'] = 'required';
            $rules['nrp'] = 'required|unique:pegawai';
            $rules['email'] = 'required|email';
            $rules['username'] = 'required|unique:users,username';
        }

        $request->validate($rules);

        $data_unit = [
            'nama' => $request->nama_unit,
            'deskripsi' => $request->deskripsi,
        ];

        // jika pegawai_id memiliki nilai
        if ($request->pegawai_id != null) {

            $data_unit['pegawai_id'] = $request->pegawai_id;

            $pegawai = Pegawai::find($request->pegawai_id);
            
            // ubah role user menjadi kepala
            $user = User::where('pegawai_id', $pegawai->user_id)->first();
            $user->update([
                'role' => 2,
            ]);

            // ubah jabatan pegawai menjadi kepala
            $user->pegawai->update([
                'jabatan' => 'Kepala',
            ]);

        }else{

            $data_user = [
                'nama' => $request->nama_kepala,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password ?? 'password123'),
                'role_id' => 2,
            ];
    
            // simpan data user
            $user = User::create($data_user);
            
            // simpan data pegawai
            $pegawai = Pegawai::create([
                'user_id' => $user->id,
                'nama' => $request->nama_kepala,
                'nrp' => $request->nrp,
                'jabatan' => 'Kepala',
            ]);

            // masukkan pegawai_id ke data unit
            $data_unit['pegawai_id'] = $pegawai->id;
        }

        // simpan data ke tabel unit
        $unit = Unit::create($data_unit);

        // update kepala_id pada tabel pegawai
        $pegawai->update([
            'kepala_id' => $unit->id,
            'unit_id' => $unit->id,
        ]);

        return back()->with('success', 'Data unit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $data = [
            'unit' => $unit,
            'pegawai' => Pegawai::where('unit_id', $unit->id)->get(),
        ];

        return view('admin.unit.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $rules = [
            'nama_unit' => 'required|unique:unit,nama,'.$unit->id,
            'deskripsi' => 'required',
            'pegawai_id' => 'required',
        ];

        $request->validate($rules);

        $data_unit = [
            'nama' => $request->nama_unit,
            'deskripsi' => $request->deskripsi,
        ];

        // simpan data unit
        $unit->update($data_unit);

        // ubah status kepala unit yang lama
        $kepala_lama = Pegawai::where('kepala_id', $unit->id)->first();

        $kepala_lama->update([
            'kepala_id' => null,
            'jabatan' => 'pegawai',
        ]);

        // ubah data user kepala lama
        $user_kepala_lama = User::find($kepala_lama->user_id);

        $user_kepala_lama->update([
            'role' => 3,
        ]);

        // cari pegawai
        $pegawai = Pegawai::find($request->pegawai_id);
        
        // ubah role user menjadi kepala
        $user = User::find( $pegawai->user_id);
        $user->update([
            'role' => 2,
        ]);

        // ubah jabatan pegawai menjadi kepala
        $pegawai->update([
            'jabatan' => 'Kepala',
            'kepala_id' => $unit->id,
            'unit_id' => $unit->id,
        ]);

        return back()->with('success', 'Data unit berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
