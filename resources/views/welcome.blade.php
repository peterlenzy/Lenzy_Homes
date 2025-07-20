<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
         .navbar-vertical {
      position: left;
      top: 0;
      left: 0;
      height: 100%;
      z-index: 1000;
    }
        .main-content {
      /* margin-right: 260px; */
      padding: 80px 20px 60px 20px;
      min-height: calc(100vh - 60px);
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: rgb(249, 248, 250);
      text-align: center;
      padding: 1rem;
      border-top: 1px solid #dee2e6;
      z-index: 1000;
    }

    </style>
</head>
<body>
<div class="container">
<div class="app-content">
<!-- <div class="card shadow mt-2"> -->
<div class="card mb-2 mt-2">
@if (Route::has('login'))
<nav class="d-flex justify-content-end mb-3 mt-auto">
    @auth
        <a href="{{ route('houses.index') }}"class="btn btn-outline-dark mx-2"style="font-size: 0.875rem;" > Welcome </a>
    @else
    <div class="btn-group border rounded">
        <a href="{{ route('login') }}" class="btn btn-outline-dark"style="font-size: 0.875rem;" >Log in </a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}"class="btn btn-outline-dark"style="font-size: 0.875rem;" >Sign Up</a>
        @endif
    </div>
    @endauth
</nav>
@endif
</div>
<!-- <div class="card mb-8"> -->
    <div class="row">
    <div class="col">
    <h1 class="mb-4">Explore To Our Precious Available Houses</h1>
    </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
    @foreach ($houses as $house)
        <div class="col">
            <div class="card shadow-sm">
                @if($house->images && $house->images->count())
        <div id="carousel-{{ $house->id }}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        @foreach($house->images as $key => $image)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <img src="{{ asset($image->img_path) }}" class="d-block w-100" alt="{{ $image->type }} image" style="height: 250px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <span class="badge bg-dark">{{ ucfirst($image->type) }}</span>
                </div>
            </div>
        @endforeach
    </div>
    @if($house->images->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $house->id }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $house->id }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
    </div>
    @else
        <img class="card-img-top" src="{{ asset('build/assets/images/default.jpg') }}" alt="No image available" style="height: 250px; object-fit: cover;">
    @endif
    <div class="card-body p-2">
        <p class="mb-2"><strong>Name:</strong> {{ $house->name }}</p>
        <p class="mb-2"><strong>City:</strong> {{ $house->city }}</p>
        <p class="mb-2"><strong>Bedrooms:</strong> {{ $house->bedrooms }}</p>
        <p class="mb-2"><strong>Status:</strong> {{ ucfirst($house->status) }}</p>
    </div>
    <div class="card-footer d-flex gap-2 flex-wrap">
        <a href="{{ route('houses.3d_view', $house->id) }}" class="btn btn-info mt-2"> View in 3D </a>
        <a href="{{ route('register') }}" class="btn btn-info mt-2"> View More Details </a>
    </div>
    </div>
    </div>
    @endforeach
</div>
</div>
<footer class="fixed bottom-0 left-0 w-full py-4 bg-white dark:bg-gray-800 text-center text-sm text-black dark:text-white/70 border-t">
    <strong>© {{ date('Y') }} Lenzy Homes App.</strong> All rights reserved.
</footer>
</div>
</div>
</div>
<script src="../build/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
