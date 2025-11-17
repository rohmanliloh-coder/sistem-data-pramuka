<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Anggota</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('anggota.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label>Nama</label>
                    <input type="text" name="nama" class="w-full rounded" required>
                </div>

                <div>
                    <label>NTA</label>
                    <input type="text" name="nta" class="w-full rounded">
                </div>

                <div>
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full rounded">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label>Golongan</label>
                    <input type="text" name="golongan" class="w-full rounded">
                </div>

                <div>
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="w-full rounded">
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="w-full rounded">
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full rounded">
                </div>

                <div>
                    <label>Nomor HP</label>
                    <input type="text" name="nomor_hp" class="w-full rounded">
                </div>

                <div class="col-span-2">
                    <label>Alamat</label>
                    <textarea name="alamat" class="w-full rounded"></textarea>
                </div>

                <div class="col-span-2">
                    <label>Foto</label>
                    <input type="file" name="foto" class="w-full">
                </div>

                <div class="col-span-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan
                    </button>
                </div>

            </div>

        </form>

    </div>

</x-app-layout>
