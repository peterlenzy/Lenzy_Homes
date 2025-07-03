<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lenzy Homes</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    </head>
    <body class="container">
        <header class="w-100% mb-2">
            <div class="card shadow mt-4">
                <div class="card-header ">
                    @if (Route::has('login'))
                        <nav class="d-flex justify-content-end">
                            @auth
                                <a
                                    href="{{ route('houses.index') }}"
                                    class="btn btn-outline-dark mx-2"
                                    style="font-size: 0.875rem;"
                                >
                                    Welcome
                                </a>
                            @else
                                <div class="btn-group border rounded">
                                    <a
                                        href="{{ route('login') }}"
                                        class="btn btn-outline-dark"
                                        style="font-size: 0.875rem;"
                                    >
                                        Log in
                                    </a>
                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="btn btn-outline-dark"
                                            style="font-size: 0.875rem;"
                                        >
                                            Sign Up
                                        </a>
                                    @endif
                                </div>
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </header>
        <div class="row w-100" style="max-width: 335px; max-width: 896px;">
        </div>
        <div class="card">
            <div class="card-header pt-4">
                <div class="col">
                <h1 class="h3 fw-bold mb-2 text-center">
                    <span class="text-dark">Welcome to Lenzy Homes where you can find your dream home</span>
                </h1>
            </div>
                <p class="text-center text-muted" style="font-size: 0.875rem;">
                    Explore our listings, connect with agents, and find the perfect place to call a home.
                </p>
            </div>
            <div class="card-body text-center pt-4">
            <div class="w-100">
            <img src="{{ asset('build/assets/images/smarthome.png') }}"
             alt="Logo"
             class="img-fluid w-100 d-block"
             style="object-fit: cover; margin-bottom: 1.5rem;max-height: 480px;"
            >
            </div>
            </div>
            </div>
        </div>
        <footer class="w-100 mt-4 text-center" style="max-width: 335px; max-width: 896px; font-size: 0.875rem;">
            <p class="text-muted">
                © {{ date('Y') }} Lenzy Homes. All rights reserved.
            </p>
        </footer>
        @if (Route::has('login'))
            <div class="d-none d-lg-block" style="height: 58px;"></div>
        @endif
        <!-- Bootstrap JS (Optional, for components requiring JavaScript) -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    </body>
</html>
