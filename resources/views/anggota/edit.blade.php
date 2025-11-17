@extends('layouts.app')

@section('content')
    <h3>Edit Anggota</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('anggota.form')
            </form>
        </div>
    </div>
@endsection
