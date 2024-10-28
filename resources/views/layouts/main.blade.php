<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<!-- Nav -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Books</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Books</a>
            </li>

            @if(auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="#">Upload</a>
                </li>
            @endif
        </ul>
        <!-- Profile and search -->
        <div class="d-flex align-items-center">
{{--            <livewire:search-dropdown />--}}
            @auth
                <a href="#" class="nav-link">
                    Osaka
                </a>
            @else
                <a href="#" class="nav-link">Login</a>
            @endauth
        </div>

    </div>
</nav>

<!-- Content -->
<main class="container my-4">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer bg-light py-3">
    <div class="container text-center">
        <span>Made by Lemiil</span>
    </div>
</footer>

<!-- Livewire и Bootstrap JS -->
<livewire:scripts />
@yield('scripts')
</body>
</html>
