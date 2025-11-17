@extends('layouts.app')

@section('title', 'Edit Golongan')

@section('content')
    <div class="container mt-3">
        <h3 class="mb-3">Edit Golongan</h3>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('golongan.update', $golongan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Nama Golongan</label>
                        <input type="text" name="nama" class="form-control" value="{{ $golongan->nama }}" required>
                    </div>

                    <button class="btn btn-warning">Update</button>
                    <a href="{{ route('golongan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
