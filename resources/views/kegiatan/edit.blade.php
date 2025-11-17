<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Riwayat Kegiatan</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label>Nama Anggota</label>
                    <select name="anggota_id" class="w-full rounded">
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}" {{ $kegiatan->anggota_id == $a->id ? 'selected' : '' }}>
                                {{ $a->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" class="w-full rounded">
                </div>

                <div>
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $kegiatan->tanggal }}" class="w-full rounded">
                </div>

                <div>
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" value="{{ $kegiatan->keterangan }}" class="w-full rounded">
                </div>

                <div class="col-span-2">
                    <label>Foto Bukti (optional)</label>
                    <input type="file" name="foto_bukti" class="w-full">

                    @if ($kegiatan->foto_bukti)
                        <img src="{{ asset('storage/'.$kegiatan->foto_bukti) }}" class="h-20 mt-2 rounded">
                    @endif
                </div>

                <div class="col-span-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                </div>

            </div>

        </form>

    </div>

</x-app-layout>
