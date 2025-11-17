<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    protected $fillable = ['nama','keterangan'];

    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }
}
