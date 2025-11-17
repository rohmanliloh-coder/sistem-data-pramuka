<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pramuka Panel</title>

    <!-- Tailwind + Bootstrap via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light font-sans">

    <div class="d-flex">

        <!-- SIDEBAR COLORFUL -->
        <aside class="d-flex flex-column flex-shrink-0 p-3 text-white shadow-lg"
            style="width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #e53935, #fb8c00, #43a047, #1e88e5, #8e24aa);">

            <h3 class="text-center fw-bold mb-4">🌈 PANEL PRAMUKA</h3>

            <ul class="nav nav-pills flex-column mb-auto">

                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white fw-semibold bg-white bg-opacity-25 rounded px-3 py-2">
                        📊 Dashboard
                    </a>
                </li>

                <li class="mb-2">
                    <a href="{{ route('anggota.index') }}" class="nav-link text-white bg-white bg-opacity-25 rounded px-3 py-2">
                        👥 Data Anggota
                    </a>
                </li>

                <li class="mb-2">
                    <a href="{{ route('kegiatan.index') }}" class="nav-link text-white bg-white bg-opacity-25 rounded px-3 py-2">
                        🎉 Kegiatan
                    </a>
                </li>

                <li class="mb-2">
                    <a href="{{ route('profile.edit') }}" class="nav-link text-white bg-white bg-opacity-25 rounded px-3 py-2">
                        🙍 Profil
                    </a>
                </li>

                <li class="mb-2">
                    <a href="{{ route('settings.index') }}" class="nav-link text-white bg-white bg-opacity-25 rounded px-3 py-2">
                        ⚙ Pengaturan
                    </a>
                </li>
            </ul>

            <hr class="border-light">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger w-100 fw-bold shadow">
                    🚪 Logout
                </button>
            </form>
        </aside>

        <!-- CONTENT AREA -->
        <main class="flex-grow-1" style="margin-left:260px">

            <!-- TOPBAR -->
            <nav class="navbar navbar-light bg-white shadow-sm px-4 sticky-top">
                <span class="navbar-brand mb-0 h4 text-primary fw-bold">
                    {{ $title ?? 'Dashboard' }}
                </span>

                <div class="d-flex align-items-center gap-3">
                    <span class="fw-semibold text-dark">{{ auth()->user()->name }}</span>
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                        style="width:40px;height:40px;background:linear-gradient(135deg,#1e88e5,#8e24aa)">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </nav>

            <!-- MAIN CONTENT -->
            <div class="container py-4">
                {{ $slot }}
            </div>

        </main>

    </div>

</body>

</html>
