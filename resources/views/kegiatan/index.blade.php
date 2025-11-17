@extends('layouts.app')

@section('title', 'Data Kegiatan')

@section('content')
    <div class="container mt-3">
        <h3 class="mb-3">Data Kegiatan</h3>

        <a href="{{ route('kegiatan.create') }}" class="btn btn-primary mb-3">+ Tambah Kegiatan</a>

        <div class="card">
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kegiatans as $kegiatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $kegiatan->tanggal }}</td>
                                <td>{{ $kegiatan->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach

                        @if ($kegiatans->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Belum ada kegiatan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
