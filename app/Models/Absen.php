<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = ['parent', 'mahasiswa_id', 'status', 'pertemuan', 'rangkuman', 'berita_acara', 'jadwal_id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
    public function getTanggalAttribute($value)
    {

        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }
}
