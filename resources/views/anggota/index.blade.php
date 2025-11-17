<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">Data Anggota</h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('anggota.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Anggota</a>

        <table class="w-full mt-4 bg-white rounded shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Foto</th>
                    <th class="p-2">Nama</th>
                    <th class="p-2">NTA</th>
                    <th class="p-2">JK</th>
                    <th class="p-2">Golongan</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $a)
                    <tr class="border-b">
                        <td class="p-2">
                            @if($a->foto)
                                <img src="{{ asset('storage/'.$a->foto) }}" class="h-12 rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-2">{{ $a->nama }}</td>
                        <td class="p-2">{{ $a->nta }}</td>
                        <td class="p-2">{{ $a->jenis_kelamin }}</td>
                        <td class="p-2">{{ $a->golongan }}</td>
                        <td class="p-2">
                            <a href="{{ route('anggota.edit', $a->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                            <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded"
                                    onclick="return confirm('Hapus?')">Hapus</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $anggota->links() }}

    </div>

</x-app-layout>
