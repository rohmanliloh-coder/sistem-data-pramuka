<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'anggota_id',
        'nama_kegiatan',
        'tanggal',
        'keterangan',
        'foto_bukti'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
