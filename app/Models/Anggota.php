<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'tanggal_lahir',
        'golongan_id',
        'foto'
    ];

    protected $dates = ['tanggal_lahir'];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

    public function kegiatans()
    {
        return $this->belongsToMany(Kegiatan::class, 'anggota_kegiatan')
                    ->withPivot('peran')
                    ->withTimestamps();
    }
}
