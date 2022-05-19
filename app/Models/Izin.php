<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    public $table = 'izin';
    protected $guarded = ['id'];

    // eloquent relationship
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    
    public function pengganti()
    {
        return $this->belongsTo(Pegawai::class, 'pengganti_id');
    }

    // scope
    public function scopeJoinCuti($query)
    {
        $query->join('pegawai', 'pegawai.id', '=', 'izin.pegawai_id')
            ->where('izin.permohonan', '=', 2)
            ->select('izin.*', 'pegawai.nama', 'pegawai.nrp');
    }

    public function scopeJoinIzin($query)
    {
        $query->join('pegawai', 'pegawai.id', '=', 'izin.pegawai_id')
            ->where('izin.permohonan', '=', 1)
            ->select('izin.*', 'pegawai.nama', 'pegawai.nrp');
    }

    public function scopeJoinPegawai($query)
    {
        $query->join('pegawai', 'pegawai.id', '=', 'izin.pegawai_id')
            ->select('izin.*', 'pegawai.nama', 'pegawai.nrp');
    }

    function scopeFilter($query, $filter){
        $query->where('nrp', 'like', "%{$filter}%")
            ->orWhere('nama', 'like', "%{$filter}%")
            ->orWhere('jenis', 'like', "%{$filter}%")
            ->orWhere('tgl_mulai', 'like', "%{$filter}%")
            ->orWhere('tgl_akhir', 'like', "%{$filter}%");
    }

    public function scopeFilterLaporan($query, $tgl_mulai, $tgl_akhir)
    {
        $query->where('tgl_mulai', '>=', $tgl_mulai)
            ->where('tgl_mulai', '<=', $tgl_akhir)
            ->where('tgl_akhir', '<=', $tgl_mulai)
            ->where('tgl_akhir', '<=', $tgl_akhir);
    }
}
