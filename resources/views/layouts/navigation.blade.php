<!-- resources/views/layouts/navigation.blade.php -->

<div x-data="{ open: false }" class="flex">

    <!-- Sidebar -->
    <aside 
        :class="open ? 'translate-x-0' : '-translate-x-64'"
        class="fixed z-40 inset-y-0 left-0 w-64 bg-indigo-800 text-white shadow-xl transform transition-transform duration-300 ease-in-out md:translate-x-0">

        <div class="px-6 py-6 border-b border-indigo-700 flex items-center justify-between">
            <div class="text-2xl font-bold tracking-wide">PRAMUKA</div>

            <!-- Mobile Close Button -->
            <button @click="open = false" class="md:hidden text-white">
                ✕
            </button>
        </div>

        <nav class="mt-4">

            <!-- Menu Item -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 py-3 px-6 hover:bg-indigo-700 transition
               {{ request()->routeIs('dashboard') ? 'bg-indigo-700' : '' }}">

                <x-heroicon-o-home class="w-5 h-5"/>
                Dashboard
            </a>

            <a href="{{ route('anggota.index') }}"
               class="flex items-center gap-3 py-3 px-6 hover:bg-indigo-700 transition
               {{ request()->routeIs('anggota.*') ? 'bg-indigo-700' : '' }}">

                <x-heroicon-o-users class="w-5 h-5"/>
                Data Anggota
            </a>

            <a href="{{ route('kegiatan.index') }}"
               class="flex items-center gap-3 py-3 px-6 hover:bg-indigo-700 transition
               {{ request()->routeIs('kegiatan.*') ? 'bg-indigo-700' : '' }}">

                <x-heroicon-o-calendar class="w-5 h-5"/>
                Kegiatan Pramuka
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 py-3 px-6 hover:bg-indigo-700 transition
               {{ request()->routeIs('profile.*') ? 'bg-indigo-700' : '' }}">

                <x-heroicon-o-user class="w-5 h-5"/>
                Profil
            </a>

            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 py-3 px-6 hover:bg-indigo-700 transition
               {{ request()->routeIs('settings.*') ? 'bg-indigo-700' : '' }}">

                <x-heroicon-o-cog-6-tooth class="w-5 h-5"/>
                Pengaturan
            </a>

            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button class="w-full flex items-center gap-3 py-3 px-6 bg-red-600 hover:bg-red-500 transition">
                    <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5"/>
                    Logout
                </button>
            </form>

        </nav>

    </aside>


    <!-- Main Content -->
    <div class="flex-1 md:ml-64 min-h-screen bg-gray-100">

        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4 flex items-center justify-between sticky top-0 z-30">

            <!-- Sidebar Toggle Mobile -->
            <button @click="open = true" class="md:hidden text-indigo-700">
                <x-heroicon-o-bars-3 class="w-7 h-7"/>
            </button>

            <h1 class="text-lg font-semibold text-gray-700">
                {{ $title ?? 'Dashboard' }}
            </h1>

            <div class="flex items-center gap-3">

                <span class="text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6366F1&color=fff"
                     class="w-9 h-9 rounded-full shadow"/>
            </div>
        </header>

        <!-- Content -->
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>

</div>
