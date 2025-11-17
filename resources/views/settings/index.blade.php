<x-app-layout>
    <x-slot name="title">Pengaturan Akun</x-slot>

    <div class="row g-4">

        <!-- UBAH PASSWORD -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    🔐 Ubah Password
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('settings.update.password') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100 fw-bold">Simpan Password</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- UBAH FOTO PROFIL -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold">
                    🖼️ Ganti Foto Profil
                </div>

                <div class="card-body">

                    @if(auth()->user()->profile_photo)
                        <div class="text-center mb-3">
                            <img src="{{ asset(auth()->user()->profile_photo) }}"
                                 class="rounded-circle shadow"
                                 width="120" height="120">
                        </div>
                    @endif

                    <form action="{{ route('settings.update.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Pilih Foto</label>
                            <input type="file" name="photo" class="form-control" accept="image/*" required>
                            @error('photo')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-success w-100 fw-bold">Upload Foto</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
