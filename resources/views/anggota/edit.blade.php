<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Data Anggota</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('anggota.update', $anggota->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ $anggota->nama }}" class="w-full rounded" required>
                </div>

                <div>
                    <label>NTA</label>
                    <input type="text" name="nta" value="{{ $anggota->nta }}" class="w-full rounded">
                </div>

                <div>
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full rounded">
                        <option value="L" {{ $anggota->jenis_kelamin === 'L' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="P" {{ $anggota->jenis_kelamin === 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>

                <div>
                    <label>Golongan</label>
                    <input type="text" name="golongan" value="{{ $anggota->golongan }}" class="w-full rounded">
                </div>

                <div>
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" value="{{ $anggota->jabatan }}" class="w-full rounded">
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ $anggota->tempat_lahir }}"
                        class="w-full rounded">
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ $anggota->tanggal_lahir }}"
                        class="w-full rounded">
                </div>

                <div>
                    <label>Nomor HP</label>
                    <input type="text" name="nomor_hp" value="{{ $anggota->nomor_hp }}" class="w-full rounded">
                </div>

                <div class="col-span-2">
                    <label>Alamat</label>
                    <textarea name="alamat" class="w-full rounded">{{ $anggota->alamat }}</textarea>
                </div>

                <div class="col-span-2">
                    <label>Foto (opsional)</label>
                    <input type="file" name="foto" class="w-full">

                    @if ($anggota->foto)
                        <img src="{{ asset('storage/' . $anggota->foto) }}" class="h-20 mt-2 rounded">
                    @endif
                </div>

                <div class="col-span-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">
                        Update
                    </button>
                </div>

            </div>

        </form>

    </div>

</x-app-layout>
