<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sistem Anggota' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 70px;
        }

        .table-img {
            max-width: 80px;
            max-height: 60px;
            object-fit: cover;
        }
    </style>

    @stack('styles')
</head>

<body>
    @include('layouts.navbar')

    <main class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-5 py-3 bg-light">
        <div class="container text-center">
            <small>&copy; {{ date('Y') }} Sistem Data Anggota</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script>
        document.addEventListener('change', function(e) {
            if (e.target.matches('input[type="file"][name="foto"]')) {
                const inp = e.target;
                const file = inp.files && inp.files[0];
                if (!file) return;
                const img = document.createElement('img');
                img.style.maxWidth = '100%';
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const preview = inp.closest('form').querySelector('.foto-preview');
                    if (preview) {
                        preview.src = ev.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>
