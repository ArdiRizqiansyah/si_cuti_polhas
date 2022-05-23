<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public $table = 'unit';
    protected $guarded = ['id'];

    // eloquent relation
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'unit_id');
    }

    public function kepala()
    {
        return $this->hasOne(Pegawai::class, 'kepala_id');
    }

    public function izin()
    {
        return $this->hasMany(Izin::class, 'unit_id');
    }
    
    // scope seacrh unit
    public function scopeSearch($query, $keyword)
    {
        $query->where('nama', 'like', "%$keyword%");
        $query->orWhere('deskripsi', 'like', "%$keyword%");
    }
}
