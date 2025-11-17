@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5>Total Anggota</h5>
                        <h3>{{ $totalAnggota }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5>Total Kegiatan</h5>
                        <h3>{{ $totalKegiatan }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5>Total Golongan</h5>
                        <h3>{{ $totalGolongan }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5>Kegiatan Populer</h5>
                        <h3>{{ $popular->first()?->anggotas_count ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 g-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Kegiatan Terbaru</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($recentKegiatan as $k)
                                <li class="list-group-item">
                                    <strong>{{ $k->nama_kegiatan }}</strong><br>
                                    <small class="text-muted">{{ $k->tanggal }}</small>
                                </li>
                            @endforeach
                            @if ($recentKegiatan->isEmpty())
                                <li class="list-group-item text-muted">Tidak ada kegiatan.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Anggota Terbaru</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($recentAnggota as $a)
                                <li class="list-group-item">
                                    {{ $a->nama }} <small
                                        class="text-muted">({{ $a->created_at?->format('Y-m-d') }})</small>
                                </li>
                            @endforeach
                            @if ($recentAnggota->isEmpty())
                                <li class="list-group-item text-muted">Tidak ada anggota.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a class="btn btn-outline-secondary" href="{{ route('export.anggota.excel') }}">Export Anggota (Excel)</a>
            <a class="btn btn-outline-secondary" href="{{ route('export.kegiatan.pdf') }}">Export Kegiatan (PDF)</a>
        </div>
    </div>
@endsection
