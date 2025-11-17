<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::with('anggota')->latest()->paginate(10);
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        return view('kegiatan.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'nama_kegiatan' => 'required',
            'tanggal' => 'required',
            'foto_bukti' => 'image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_bukti')) {
            $data['foto_bukti'] = $request->file('foto_bukti')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Riwayat kegiatan berhasil ditambahkan');
    }

    public function edit(Kegiatan $kegiatan)
    {
        $anggota = Anggota::all();
        return view('kegiatan.edit', compact('kegiatan', 'anggota'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'anggota_id' => 'required',
            'nama_kegiatan' => 'required',
            'tanggal' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_bukti')) {
            $data['foto_bukti'] = $request->file('foto_bukti')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Riwayat kegiatan berhasil diperbarui');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus');
    }
}
