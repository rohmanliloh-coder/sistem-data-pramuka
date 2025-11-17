<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-lg shadow border border-slate-200">
            <h2 class="text-slate-600 font-semibold">Total Anggota</h2>
            <p class="text-3xl mt-3 text-blue-600 font-bold">{{ $totalAnggota }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow border border-slate-200">
            <h2 class="text-slate-600 font-semibold">Total Kegiatan</h2>
            <p class="text-3xl mt-3 text-blue-600 font-bold">{{ $totalKegiatan }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow border border-slate-200">
            <h2 class="text-slate-600 font-semibold">Anggota Baru</h2>
            <p class="text-slate-500 mt-3">Belum ada anggota baru.</p>
        </div>

    </div>

    <div class="mt-6 bg-white p-6 rounded-lg shadow border border-slate-200">
        <h2 class="text-slate-600 font-semibold mb-3">Kegiatan Terbaru</h2>
        <p class="text-slate-500">Belum ada kegiatan terbaru.</p>
    </div>
</x-app-layout>
