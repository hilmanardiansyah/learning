<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = ['kelas_id', 'dosen_id', 'matkul_id', 'hari', 'jam_masuk', 'jam_keluar'];

    public $timestamp = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function absens()
    {
        return $this->hasMany(Absen::class);
    }
}
