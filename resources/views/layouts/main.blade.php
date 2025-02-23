<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>@yield('title') | Books!</title>
    @vite(['resources/assets/css/main.css'])
    @vite(['resources/assets/css/js.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/641661813d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>
<body>
<div class="wrapper">
    <!-- Nav -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top px-3">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">
                    <i class="fas fa-book"></i> Books!
                </a>

                <div class="justify-content-center" id="navbarNav">
                    <ul class="navbar-nav" style="margin-left: 120px">
                        <li class="">
                            <a class="nav-link" href="#"><i class="fas fa-book-open"></i> Books</a>
                        </li>

                        @if(auth()->check())
                            <li class="">
                                <a class="nav-link" href="#"><i class="fas fa-upload"></i> Upload</a>
                            </li>
                        @endif

                        <li class="">
                            <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> About</a>
                        </li>
                    </ul>
                </div>


                <div class="d-flex align-items-center">

                    <div class="me-3">
                        <input type="text" id="search" placeholder="Поиск книги..." autocomplete="off">
                        <div id="results" class="dropdown"></div>
                    </div>

                    @auth
                        <a href="#" class="nav-link text-light">
                            <i class="fas fa-user"></i> {{ auth()->user()->name }}
                        </a>
                    @else
                        <a href="#" class="nav-link text-light">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <div class="mb-3 "></div>

    <!-- Content -->
    <main id='main' class="container mt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bd-footer bg-dark py-3 mt-5">
        <div class="container text-white text-center">
            <span>Made by Lemiil</span>
        </div>
    </footer>
</div>


<script src="https://app.embed.im/snow.js" defer></script>
</body>
</html>
