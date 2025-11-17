<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'nama',
        'nta',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'golongan',
        'jabatan',
        'nomor_hp',
        'foto',
    ];

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
