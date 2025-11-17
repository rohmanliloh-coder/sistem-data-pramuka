<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Ringkasan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-blue-500 text-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold">Total Anggota</h3>
                    <p class="text-4xl font-bold mt-2">{{ $totalAnggota }}</p>
                </div>

                <div class="bg-green-500 text-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-semibold">Total Kegiatan</h3>
                    <p class="text-4xl font-bold mt-2">{{ $totalKegiatan }}</p>
                </div>
            </div>

            {{-- Anggota Baru --}}
            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <h3 class="text-lg font-bold mb-4">Anggota Baru</h3>

                @if ($anggotaBaru->count())
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-3">Nama</th>
                                <th class="p-3">Jabatan</th>
                                <th class="p-3">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggotaBaru as $a)
                                <tr class="border-b">
                                    <td class="p-3">{{ $a->nama }}</td>
                                    <td class="p-3">{{ $a->jabatan }}</td>
                                    <td class="p-3">{{ $a->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">Belum ada anggota baru.</p>
                @endif
            </div>

            {{-- Kegiatan Terbaru --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-bold mb-4">Kegiatan Terbaru</h3>

                @if ($kegiatanTerbaru->count())
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-3">Nama Kegiatan</th>
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Tempat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatanTerbaru as $k)
                                <tr class="border-b">
                                    <td class="p-3">{{ $k->nama_kegiatan }}</td>
                                    <td class="p-3">{{ date('d M Y', strtotime($k->tanggal)) }}</td>
                                    <td class="p-3">{{ $k->lokasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">Belum ada kegiatan.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
