@extends('layouts.app')

@section('title', 'Detail Kegiatan')

@section('content')
    <div class="container mt-3">
        <h3 class="mb-3">Detail Kegiatan</h3>

        <div class="card">
            <div class="card-body">

                <p><strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>
                <p><strong>Tanggal:</strong> {{ $kegiatan->tanggal }}</p>
                <p><strong>Deskripsi:</strong> {{ $kegiatan->deskripsi }}</p>

                <hr>

                <h5>Daftar Anggota Ikut Kegiatan</h5>
                <ul>
                    @foreach ($kegiatan->anggotas as $a)
                        <li>{{ $a->nama }} ({{ $a->pivot->peran ?? '-' }})</li>
                    @endforeach

                    @if ($kegiatan->anggotas->isEmpty())
                        <li>Belum ada anggota yang mengikuti kegiatan ini.</li>
                    @endif
                </ul>

                <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
