<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Pramuka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">🏕️ Toko Pramuka</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('transactions.index') }}">Transaksi</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Produk</a></li>
          <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="btn btn-outline-light btn-sm ms-2">Logout</button>
              </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<header class="bg-primary text-white text-center py-5">
  <div class="container">
    <h1>Selamat Datang di Toko Pramuka</h1>
    <p>Perlengkapan pramuka lengkap dan berkualitas!</p>
  </div>
</header>

<section class="container my-5">
  <h2 class="text-center mb-4">Produk Kami</h2>
  <div class="row">
    @foreach(\App\Models\Product::take(6)->get() as $product)
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body text-center">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
          @auth
          <a href="{{ route('transactions.create') }}" class="btn btn-success">Beli Sekarang</a>
          @else
          <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Beli</a>
          @endauth
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>

<footer class="bg-dark text-white text-center py-3">
  <small>&copy; {{ date('Y') }} Toko Pramuka. All rights reserved.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
