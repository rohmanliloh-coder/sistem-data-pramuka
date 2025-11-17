@extends('layouts.app')

@section('content')
    <h3>Detail Anggota</h3>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    @if ($anggota->foto)
                        <img src="{{ asset('photos/' . $anggota->foto) }}" class="img-fluid" alt="">
                    @endif
                </div>
                <div class="col-md-9">
                    <h4>{{ $anggota->nama }}</h4>
                    <p>Golongan: {{ $anggota->golongan->nama ?? '-' }}</p>
                    <p>Alamat: {{ $anggota->alamat }}</p>
                    <p>Tanggal Lahir: {{ $anggota->tanggal_lahir?->format('Y-m-d') }}</p>

                    <h5>Kegiatan Diikuti</h5>
                    @forelse($anggota->kegiatans as $k)
                        <div class="mb-2">
                            <strong>{{ $k->nama_kegiatan }}</strong><br>
                            <small class="text-muted">{{ $k->tanggal }} - {{ $k->tempat }}</small>
                        </div>
                    @empty
                        <div class="text-muted">Belum ada</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
