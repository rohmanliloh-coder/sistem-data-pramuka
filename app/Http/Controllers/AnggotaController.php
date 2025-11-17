<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Golongan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AnggotaController extends Controller
{
    /**
     * Pilih kolom yg aman untuk orderBy pada tabel golongans.
     * Mengembalikan nama kolom yang ada (prioritas pada kolom umum).
     */
    protected function detectGolonganOrderColumn(): string
    {
        // kolom preferensi (dari yang paling diharapkan)
        $preferred = [
            'nama', 'name', 'nama_golongan', 'golongan', 'kode', 'pangkat', 'id',
        ];

        // jika tabel tidak ada atau Schema tidak bisa, fallback 'id'
        if (! Schema::hasTable('golongans')) {
            return 'id';
        }

        $cols = Schema::getColumnListing('golongans');

        foreach ($preferred as $c) {
            if (in_array($c, $cols)) {
                return $c;
            }
        }

        // jika tidak ada kolom preferensi, ambil kolom pertama (jika ada)
        if (! empty($cols)) {
            return $cols[0];
        }

        // fallback
        return 'id';
    }

    public function index(Request $request)
    {
        $query = Anggota::query();

        if ($request->filled('golongan_id')) {
            $query->where('golongan_id', $request->golongan_id);
        }

        $anggotas = $query->orderBy('nama', 'asc')->paginate(10);

        // gunakan deteksi kolom agar tidak memanggil kolom yang tidak ada
        $orderCol  = $this->detectGolonganOrderColumn();
        $golongans = Golongan::orderBy($orderCol, 'asc')->get();

        return view('anggota.index', compact('anggotas', 'golongans'));
    }

    public function create()
    {
        $orderCol  = $this->detectGolonganOrderColumn();
        $golongans = Golongan::orderBy($orderCol, 'asc')->get();
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();

        return view('anggota.create', compact('golongans', 'kegiatans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'alamat'        => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'golongan_id'   => 'nullable|exists:golongans,id',
            'foto'          => 'nullable|image|max:4096',
            'kegiatan_id'   => 'nullable|array',
            'kegiatan_id.*' => 'exists:kegiatans,id',
        ]);

        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos'), $filename);
            $data['foto'] = $filename;
        }

        $anggota = Anggota::create($data);

        if (! empty($data['kegiatan_id'])) {
            $anggota->kegiatans()->attach($data['kegiatan_id']);
        }

        return redirect()->route('anggota.index')->with('success', 'Anggota tersimpan.');
    }

    public function show(Anggota $anggota)
    {
        $anggota->load(['golongan', 'kegiatans']);
        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        $orderCol  = $this->detectGolonganOrderColumn();
        $golongans = Golongan::orderBy($orderCol, 'asc')->get();
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();

        return view('anggota.edit', compact('anggota', 'golongans', 'kegiatans'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'alamat'        => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'golongan_id'   => 'nullable|exists:golongans,id',
            'foto'          => 'nullable|image|max:4096',
            'kegiatan_id'   => 'nullable|array',
            'kegiatan_id.*' => 'exists:kegiatans,id',
        ]);

        if ($request->hasFile('foto')) {
            if ($anggota->foto && File::exists(public_path('photos/' . $anggota->foto))) {
                File::delete(public_path('photos/' . $anggota->foto));
            }

            $file     = $request->file('foto');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos'), $filename);
            $data['foto'] = $filename;
        }

        $anggota->update($data);

        if (isset($data['kegiatan_id'])) {
            $anggota->kegiatans()->sync($data['kegiatan_id']);
        } else {
            $anggota->kegiatans()->sync([]);
        }

        return redirect()->route('anggota.index')->with('success', 'Data anggota diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        if ($anggota->foto && File::exists(public_path('photos/' . $anggota->foto))) {
            File::delete(public_path('photos/' . $anggota->foto));
        }

        $anggota->kegiatans()->detach();
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota dihapus.');
    }
}
