<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $guarded = ['id'];

    // eloquent relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function kepala()
    {
    return $this->belongsTo(Unit::class, 'kepala_id');
    }

    public function izin()
    {
        return $this->hasMany(Izin::class, 'pegawai_id')->where('permohonan', 1);
    }

    public function cuti()
    {
        return $this->hasMany(Izin::class, 'pegawai_id')->where('permohonan', 2);
    }

    // scope seacrh pegawai
    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            $query->where('nama', 'LIKE', "%$keyword%");
            $query->orWhere('nrp', 'LIKE', "%$keyword%");
            $query->orWhere('alamat', 'LIKE', "%$keyword%");
            $query->orWhere('jabatan', 'LIKE', "%$keyword%");
        }
    }

    // mutator
    public function getGetTanggalLahirAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->locale('id')->isoFormat('D MMMM Y');
    }
}
