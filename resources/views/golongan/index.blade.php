@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Data Golongan</h3>
            <a href="{{ route('golongan.create') }}" class="btn btn-primary">+ Tambah Golongan</a>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">#</th>
                            <th>Nama Golongan</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($golongans as $g)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $g->nama_golongan }}</td>
                                <td>
                                    <a href="{{ route('golongan.edit', $g->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('golongan.destroy', $g->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">

                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-3">
                                    <em>Belum ada data golongan.</em>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
