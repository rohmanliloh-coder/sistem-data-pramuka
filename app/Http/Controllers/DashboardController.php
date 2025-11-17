<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Golongan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalKegiatan = Kegiatan::count();
        $totalGolongan = Golongan::count();

        $recentKegiatan = Kegiatan::orderBy('tanggal','desc')->limit(5)->get();
        $recentAnggota = Anggota::orderBy('created_at','desc')->limit(5)->get();

        // kegiatan with most participants (top 5)
        $popular = Kegiatan::withCount('anggotas')->orderBy('anggotas_count','desc')->limit(5)->get();

        return view('dashboard', compact(
            'totalAnggota','totalKegiatan','totalGolongan','recentKegiatan','recentAnggota','popular'
        ));
    }
}
