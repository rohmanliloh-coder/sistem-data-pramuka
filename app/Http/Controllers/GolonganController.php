<?php
namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    public function index()
    {
        // Ambil semua data golongan berdasarkan kolom yang benar
        $golongans = Golongan::orderBy('nama_golongan', 'asc')->get();

        // Kirim ke view
        return view('golongan.index', compact('golongans'));
    }

    public function create()
    {
        return view('golongan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_golongan' => 'required',
        ]);

        Golongan::create([
            'nama_golongan' => $request->nama_golongan,
        ]);

        return redirect()->route('golongan.index')->with('success', 'Golongan berhasil dibuat!');
    }

    public function edit(Golongan $golongan)
    {
        return view('golongan.edit', compact('golongan'));
    }

    public function update(Request $request, Golongan $golongan)
    {
        $request->validate([
            'nama_golongan' => 'required',
        ]);

        $golongan->update([
            'nama_golongan' => $request->nama_golongan,
        ]);

        return redirect()->route('golongan.index')->with('success', 'Golongan berhasil diperbarui!');
    }
}
