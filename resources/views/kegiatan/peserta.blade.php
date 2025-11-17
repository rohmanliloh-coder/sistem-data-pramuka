@extends('layouts.app')

@section('title', 'Kelola Peserta')

@section('content')
    <div class="container">
        <h3>Kelola Peserta: {{ $kegiatan->nama_kegiatan }}</h3>

        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('kegiatan.addParticipant', $kegiatan->id) }}" method="POST"
                    class="row g-2 align-items-end">
                    @csrf
                    <div class="col-md-6">
                        <label>Tambah Anggota</label>
                        <select name="anggota_id" class="form-control" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach ($availableAnggota as $a)
                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Peran (opsional)</label>
                        <input type="text" name="peran" class="form-control" placeholder="Peserta / Panitia">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>Daftar Peserta</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan->anggotas as $idx => $a)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ $a->nama }}</td>
                                <td>{{ $a->pivot->peran ?? '-' }}</td>
                                <td>
                                    <form method="POST"
                                        action="{{ route('kegiatan.removeParticipant', [$kegiatan->id, $a->id]) }}"
                                        onsubmit="return confirm('Hapus peserta?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($kegiatan->anggotas->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada peserta.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
