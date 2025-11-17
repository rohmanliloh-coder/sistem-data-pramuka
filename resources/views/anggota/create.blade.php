@extends('layouts.app')

@section('content')
    <h3>Tambah Anggota</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                @include('anggota.form')
            </form>
        </div>
    </div>
@endsection
