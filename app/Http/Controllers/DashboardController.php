<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung data ringkasan
        $totalAnggota = Anggota::count();
        $totalKegiatan = Kegiatan::count();

        // Ambil 5 kegiatan terbaru
        $kegiatanTerbaru = Kegiatan::latest()->take(5)->get();

        // Ambil 5 anggota terbaru
        $anggotaBaru = Anggota::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalAnggota',
            'totalKegiatan',
            'kegiatanTerbaru',
            'anggotaBaru'
        ));
    }
}
