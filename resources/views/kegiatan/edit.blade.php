@extends('layouts.app')

@section('title', 'Edit Kegiatan')

@section('content')
    <div class="container mt-3">
        <h3 class="mb-3">Edit Kegiatan</h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" class="form-control" value="{{ $kegiatan->nama_kegiatan }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $kegiatan->tanggal }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $kegiatan->deskripsi }}</textarea>
                    </div>

                    <button class="btn btn-warning">Update</button>
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
