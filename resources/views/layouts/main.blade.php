<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
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


<style>
    .dropdown {
        position: absolute;
        width: 200px;
        background: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: none;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
    }

    .dropdown a {
        text-decoration: none;
        color: black;
    }

    .dropdown p {
        padding: 10px;
        margin: 0;
        cursor: pointer;
    }

    .dropdown p:hover {
        background: #f0f0f0;
    }
</style>

<script>
    $(document).ready(function () {
        let $search = $('#search');
        let $results = $('#results');
        let timeout = null;

        $search.on('keyup', function () {
            clearTimeout(timeout);
            let query = $(this).val();

            if (query.length < 2) {
                $results.hide();
                return;
            }

            timeout = setTimeout(function () {
                $.ajax({
                    url: '{{ route("book.search") }}',
                    type: 'GET',
                    data: {query: query},
                    success: function (data) {
                        let results = '';
                        if (data != '') {
                            data.forEach(book => {
                                let bookUrl = '{{ route("book.show", ":id") }}'.replace(':id', book.id);
                                results += `<a href="${bookUrl}"><p class="result-item" data-title="${book.title}">${book.title}</p></a>`;
                            });
                            $results.html(results).show();
                        }
                    }
                });
            }, 250);
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#search, #results').length) {
                $results.hide();
            }
        });
    });


</script>


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
