@extends('layouts.app')

@section('title', 'Tambah Golongan')

@section('content')
    <div class="container mt-3">
        <h3 class="mb-3">Tambah Golongan</h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('golongan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Golongan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <button class="btn btn-success">Simpan</button>
                    <a href="{{ route('golongan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
