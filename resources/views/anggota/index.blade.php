@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Data Anggota</h3>
            <a href="{{ route('anggota.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
        </div>

        {{-- Filter Golongan --}}
        <form method="GET" action="{{ route('anggota.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label>Filter Golongan</label>
                    <select name="golongan_id" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Semua Golongan --</option>
                        @foreach ($golongans as $g)
                            <option value="{{ $g->id }}" {{ request('golongan_id') == $g->id ? 'selected' : '' }}>
                                {{ $g->nama_golongan ?? ($g->nama ?? 'Golongan ' . $g->id) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        {{-- Tabel Anggota --}}
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="60">Foto</th>
                            <th>Nama</th>
                            <th>Golongan</th>
                            <th>Kegiatan</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($anggotas as $item)
                            <tr>

                                {{-- Foto --}}
                                <td>
                                    @if ($item->foto)
                                        <img src="{{ asset('photos/' . $item->foto) }}" width="50" height="50"
                                            style="object-fit:cover" class="rounded-circle">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- Nama --}}
                                <td>{{ $item->nama }}</td>

                                {{-- Golongan --}}
                                <td>{{ $item->golongan->nama_golongan ?? '-' }}</td>

                                {{-- Kegiatan --}}
                                <td>
                                    @if ($item->kegiatans->count())
                                        <span class="badge bg-success">{{ $item->kegiatans->count() }} kegiatan</span>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <a href="{{ route('anggota.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('anggota.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('anggota.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">
                                    <em>Belum ada data anggota.</em>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $anggotas->withQueryString()->links() }}
        </div>

    </div>
@endsection
