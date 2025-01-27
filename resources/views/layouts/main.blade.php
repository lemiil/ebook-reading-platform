<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Books</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
    <main id='main' class="container mt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bd-footer bg-light py-3">
        <div class="container text-center">
            <span>Made by Lemiil</span>
        </div>
    </footer>
</div>
<style>
    html, body {
        height: 100%;
    }

    .wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    .blockquote {
        font: 13px/21px normal helvetica, sans-serif;
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 50px;
        padding-left: 15px;
        border-left: 3px solid #ccc;
    }

    .spoiler {
        color: transparent;
        background-color: #000;
        border-radius: 3px;
        padding: 0 5px;
    }

    .spoiler:hover {
        color: white;
        background-color: gray;
    }


</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        function formatText(element) {
            element.innerHTML = element.innerHTML
                .replace(/\/(.*?)\//g, "<em>$1</em>")
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/~~(.*?)~~/g, "<del>$1</del>")
                .replace(/!(.*?)!/g, '<span class="blockquote">$1</span>')
                .replace(/\|\|(.*?)\|\|/g, '<span class="spoiler">$1</span>');
        }

        const elements = document.querySelectorAll("body *:not(script):not(style)");
        elements.forEach((element) => {
            if (element.children.length === 0) {
                formatText(element);
            }
        });
    });

</script>
<script src="https://app.embed.im/snow.js" defer></script>
</body>
</html>
