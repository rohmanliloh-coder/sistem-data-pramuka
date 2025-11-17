@extends('layouts.app')

@section('title', 'Tambah Kegiatan')

@section('content')
    <div class="container mt-3">
        <h3 class="mb-3">Tambah Kegiatan</h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('kegiatan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    <button class="btn btn-success">Simpan</button>
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
