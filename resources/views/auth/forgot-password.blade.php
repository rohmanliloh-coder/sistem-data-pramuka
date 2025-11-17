@extends('layouts.app')

@section('content')
    <div class="container mt-5" style="max-width: 450px;">
        <h3 class="text-center mb-4">Lupa Password</h3>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label>Email Anda</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </div>
        </form>
    </div>
@endsection
