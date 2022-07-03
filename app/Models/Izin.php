<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function scopeFilterBetweenDate($query, $tgl_mulai, $tgl_akhir)
    {
        $query->when($tgl_mulai, function ($query) use ($tgl_mulai) {
            return $query->where('tgl_mulai', '>=', $tgl_mulai);
        })->when($tgl_akhir, function ($query) use ($tgl_akhir) {
            return $query->where('tgl_akhir', '<=', $tgl_akhir);
        });
    }

    public function scopeGroupByMonth($query)
    {
        $query->selectRaw('count(*) as jumlah, month(tgl_mulai) as bulan')
            ->groupBy('bulan');
    }

    public function scopeFilterYear($query, $year)
    {
        $query->when($year, function ($query) use ($year) {
            return $query->whereYear('created_at', $year);
        });
    }

    // mutator
    public function getGetTglPengajuanAttribute()
    {
        return date('Y-m-d', strtotime($this->created_at));
    }

    public function getGetDokumenAttribute()
    {
        return asset('storage/dokumen/'. $this->dokumen);
    }

    public function getGetFormulirAttribute()
    {
        return asset('storage/formulir/'. $this->formulir);
    }

    public function getGetJumlahHariAttribute()
    {
        $start = Carbon::parse($this->tgl_mulai);
        $end = Carbon::parse($this->tgl_akhir);
        $result = $start->diffInDays($end);

        return $result;
    }
}
