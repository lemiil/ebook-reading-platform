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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function formatText(element) {
            if (element.dataset.formatted) return;

            let originalText = element.innerHTML;
            let formattedText = originalText
                .replace(/(?<!\*)\*\*(.*?)\*\*(?!\*)/g, '<strong>$1</strong>')
                .replace(/(?<!\/)\/(.*?)\/(?!\/)/g, "<em>$1</em>")
                .replace(/~~(.*?)~~/g, "<del>$1</del>")
                .replace(/!(.*?)!/g, '<span class="blockquote">$1</span>')
                .replace(/\|\|(.*?)\|\|/g, '<span class="spoiler">$1</span>');

            if (formattedText !== originalText) {
                element.innerHTML = formattedText;
                element.dataset.formatted = "true";
            }
        }

        function processElements(root) {
            root.querySelectorAll("*:not(script):not(style):not(.editor-container textarea)").forEach(element => {
                if (!element.children.length) {
                    formatText(element);
                }
            });
        }

        processElements(document.body);

        const observer = new MutationObserver(mutations => {
            mutations.forEach(mutation => {
                mutation.addedNodes.forEach(node => {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        processElements(node);
                    }
                });
            });
        });

        observer.observe(document.body, {childList: true, subtree: true});
    });
</script>
<body>
<div class="wrapper">
    <!-- Nav -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top px-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-book"></i> Books!
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-book-open"></i> Books</a>
                    </li>

                    @if(auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-upload"></i> Upload</a>
                        </li>
                    @endif

                    <li class="nav-item text-white">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> About</a>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center">
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


<script src="https://app.embed.im/snow.js" defer></script>
</body>
</html>
