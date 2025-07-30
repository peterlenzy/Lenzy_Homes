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
      /* position: fixed; */
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: rgb(249, 248, 250);
      text-align: center;
      padding: 1rem;
      border-top: 1px solid #dee2e6;
      z-index: 1000;
    }
     body {
            background-image: url("{{ asset('build/assets/images/smart home.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            margin: 0;
        }


    </style>
</head>
<body>
<div class="container">
<div class="app-content">
<!-- <div class="card shadow mt-2"> -->
<div class="card mb-2 mt-4">
    @if (Route::has('login'))

    <nav class="d-flex justify-content-between align-items-center px-3 py-2">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('build/assets/images/smart home.png') }}" alt="Lenzy Homes logo" style="width: 40px; height: auto;">
        </a>
        <div class="card-text fw-bold fst-italic">
            Welcome to Lenzy Homes, Register or login to an existing account for more important details
        </div>

            @auth
                <a href="{{ route('houses.index') }}" class="btn btn-outline-dark mx-2" style="font-size: 0.875rem;">Welcome</a>
            @else
                <div class="btn-group border rounded">
                    <a href="{{ route('login') }}" class="btn btn-outline-dark" style="font-size: 0.875rem;">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-dark" style="font-size: 0.875rem;">Sign Up</a>
                    @endif
                </div>
            @endauth
    </nav>

    @endif
</div>
<div class="d-flex justify-content-centre align-items-center px-3 py-2 text-white">
        <div class="card-text fw-bold fst-italic d-flex justify-content-center ">
         <h1>The Lenzy Homes Limited</hi>
        </div>
</div>
<div class="d-flex justify-content-between align-items-center px-3 py-2 text-white">
<p>The Lenzy Homes Company is the leading core real estate company in Nairobi, Kenya, with an extensive, balanced portfolio that includes nationwide commercial and residential property management and real estate services.

With over 15 years of experience, we are experts in residential and commercial property management—a profound knowledge of the real estate market with a clear understanding of various market dynamics.

Our clients are drawn from various professionals, including NGOs, real estate investors, the United Nations, and cooperatives. We have a talented, techy-savvy team of professionals specializing in sourcing, letting, selling, and managing residential and commercial properties.
</p>
</div>
<div class="row d-flex justify-content-between align-items-center px-3 py-2 text-white">
    <div class="col ">
        <strong><h>Contact Links</h></strong><br>
        <a href="tel:+254734454368"><i data-feather="message-circle"></i>Message us</a><br>
        <a href="mailto:peterlenzy01@gmail.com"><i data-feather="mail"></i>Send us an email</a><br>
        <a href="tel:+254734454368"><i data-feather="phone"></i>Make a phonecall</a><br>
        <a href="https://wa.me/+254113426205"><i data-feather="message-square"></i>WhatsApp us</a><br>
        <a href="https://twitter.com/@chimneyvictim"><i data-feather="twitter"></i>Send us a Tweet</a><br>
        <a href="https://instagram.com/lenzy3177"><i data-feather="instagram"></i>Our Instagram Channel</a><br>
        <a href="https://t.me/info@lenzyhomes"><i data-feather="send"></i>Our Telegram Channel</a><br>
    </div>
    <div class="col ">
        <h4>Locate us at</h4>
        <strong><p>Nairobi Kenya</p></strong><br>
        <a href="https://www.google.com/maps/place/9+DeKalb+Ave,+Brooklyn,+NY+11201"><i data-feather="map-pin"></i>  3<sup>rd</sup> Floor, Brown house/Brooklyne towers</a><br>
    </div>
</div>
<!-- <div class="card mb-20 mt-4"> -->
    <div class="card-header">
    <div class="row">
    <div class="col">
    <h1 class="mb-4 text-white">Navigate Through Our Precious  Comfort Houses</h1>
    </div>
    </div>
    </div>
    <div class="card-body">
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
</div>
<div class="d-flex justify-content-between align-items-center px-3 py-2 text-white">
    <div class="card-footer"><strong><h12>Our Target</h12></strong><br><p>To be the optimum business template for the real estate industry.
    We Seek, capitalize and provide innovative profit solutions to our clients and maximize relationships.</p><br>
    <strong><h13>Vision</h13></strong><br>
    <p>To be the pacesetters in real estate, surpassing clients’ expectations.</p></div>
</div>
<div class="row d-flex justify-content-between align-items-center px-3 py-2 text-white">
<div class="col">
    <h3>Our opening hours</h3>
    <p>Monday to Friday</p>
    <p>8.00am-4.00pm</p>
    <p>Saturday</p>
    <p>9.00am-2.00pm</p>
</div>
 <div class="col">
    <h5>Quick reference</h5>
    <a href="mailto:peterlenzy01@gmail.com"><i data-feather="mail"></i></a><br>
    <a href="https://wa.me/+254113426205"><i data-feather="message-square"></i></a><br>
    <a href="https://instagram.com/lenzy3177"><i data-feather="instagram"></i></a><br>
    <a href="https://twitter.com/@chimneyvictim"><i data-feather="twitter"></i></a><br>
    <a href="tel:+254734454368"><i data-feather="message-circle"></i></a>
</div>
<div class="col">
    <h4>Locate us at</h4>
    <strong><p>Nairobi Kenya</p></strong><br>
    <a href="https://www.google.com/maps/place/9+DeKalb+Ave,+Brooklyn,+NY+11201"><i data-feather="map-pin"></i>  3<sup>rd</sup> Floor, Brown house/Brooklyne towers</a><br>
</div>
</div>
<footer class="fixed bottom-0 left-0 w-full py-4 bg-white dark:bg-gray-800 text-center text-sm text-black dark:text-white/70 border-t mt-3 mb-3">
    <strong>© {{ date('Y') }} Lenzy Homes App.</strong> All rights reserved.
</footer>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
<script src="../build/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
