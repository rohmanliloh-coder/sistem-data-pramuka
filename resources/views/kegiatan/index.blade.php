<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">Riwayat Kegiatan Anggota</h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('kegiatan.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Kegiatan</a>

        <table class="w-full mt-4 bg-white rounded shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Anggota</th>
                    <th class="p-2">Kegiatan</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Bukti</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kegiatan as $k)
                    <tr class="border-b">
                        <td class="p-2">{{ $k->anggota->nama }}</td>
                        <td class="p-2">{{ $k->nama_kegiatan }}</td>
                        <td class="p-2">{{ $k->tanggal }}</td>
                        <td class="p-2">
                            @if ($k->foto_bukti)
                                <img src="{{ asset('storage/' . $k->foto_bukti) }}" class="h-12 rounded">
                            @else
                                Tidak ada
                            @endif
                        </td>
                        <td class="p-2">
                            <a href="{{ route('kegiatan.edit', $k->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                            <form action="{{ route('kegiatan.destroy', $k->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded"
                                    onclick="return confirm('Hapus kegiatan ini?')">Hapus</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $kegiatan->links() }}

    </div>

</x-app-layout>
