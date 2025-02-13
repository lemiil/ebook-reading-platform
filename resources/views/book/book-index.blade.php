@extends('layouts.main')

@section('title')
    Books
@endsection

@section('content')

    <input type="text" id="search" placeholder="Поиск книги..." autocomplete="off">
    <div id="results"></div>

    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                let query = $(this).val();
                if (query.length < 2) {
                    $('#results').html('');
                    return;
                }

                $.ajax({
                    url: '{{ route("book.search") }}',
                    type: 'GET',
                    data: {query: query},
                    success: function (data) {
                        let results = '';
                        data.forEach(book => {
                            results += `<p>${book.title}</p>`;
                        });
                        $('#results').html(results);
                    }
                });
            });
        });
    </script>


    <form method="GET" action="{{ route('book.index') }}">
        <label>Сортировка:</label>
        <select name="sort" onchange="this.form.submit()">
            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>По рейтингу</option>
            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>По названию</option>
        </select>

        <label>
            <input type="checkbox" name="order" value="1"
                   onchange="this.form.submit()"
                {{ request()->boolean('order') ? 'checked' : '' }}>
            Сначала старое
        </label>
    </form>

    <div class="row mt-5">
        @foreach ($books as $book)
            <div class="col-md-2 mb-4">
                <div class="book-card">
                    <a href="{{ route('book.show', ['book' => $book->id]) }}">
                        <div class="book-cover border">
                            <img
                                src="{{ $book->cover_path ? url("/storage/$book->cover_path") : asset('storage/placeholders/book-cover-placeholder_png.png') }}"
                                height="300" class="card-img-top" alt="Обложка">
                            <div class="book-overlay">
                                <span class="book-title">{{ $book->title }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{ $books->links('vendor.pagination.bootstrap-5') }}

    <style>
        .book-card {
            position: relative;
            overflow: hidden;
        }

        .book-cover {
            position: relative;
            display: inline-block;
        }

        .book-cover img {
            display: block;
            width: 100%;
            transition: opacity 0.3s ease-in-out;
        }

        .book-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            text-align: center;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .book-cover:hover img {
            opacity: 0.5;
        }

        .book-cover:hover .book-overlay {
            opacity: 1;
        }

        .pagination .page-link {
            color: black;
        }

        .pagination .page-item.active .page-link {
            background-color: #a1a1a1;
            border-color: black;
        }
    </style>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('filterForm');
            const booksContainer = document.getElementById('booksContainer');

            function fetchBooks() {
                const formData = new FormData(form);
                const params = new URLSearchParams(formData).toString();

                fetch(`/api/books?${params}`)
                    .then(response => response.json())
                    .then(data => {
                        booksContainer.innerHTML = '';
                        if (data.data.length === 0) {
                            booksContainer.innerHTML = '<p>Книги не найдены.</p>';
                            return;
                        }
                        data.data.forEach(book => {
                            booksContainer.innerHTML += `
                                <div class="book">
                                    <h3>${book.title}</h3>
                                    <p>Рейтинг: ${book.rating}</p>
                                    <p>Просмотры: ${book.views}</p>
                                </div>
                            `;
                        });
                    });
            }

            form.addEventListener('change', fetchBooks);
            fetchBooks(); // Загружаем книги при первой загрузке
        });

    </script>

@endsection
