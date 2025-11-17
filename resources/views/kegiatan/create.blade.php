<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Riwayat Kegiatan</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('kegiatan.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label>Nama Anggota</label>
                    <select name="anggota_id" class="w-full rounded" required>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="w-full rounded" required>
                </div>

                <div>
                    <label>Tanggal Kegiatan</label>
                    <input type="date" name="tanggal" class="w-full rounded" required>
                </div>

                <div>
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="w-full rounded">
                </div>

                <div class="col-span-2">
                    <label>Foto Bukti (optional)</label>
                    <input type="file" name="foto_bukti" class="w-full">
                </div>

                <div class="col-span-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>

            </div>

        </form>

    </div>

</x-app-layout>
