@extends('layouts.main')

@section('title')
    Lib
@endsection

@section('content')

    <form id="filterForm" method="GET" action="{{ route('book.index') }}" class="d-flex justify-content-between">
        <div class="">
            <label for="title">Поиск по названию:</label>
            <input class="" type="text" id="title" name="title" value="{{ request('title') }}"
                   placeholder="Введите название">
            <button type="submit">Найти</button>
        </div>

        <div class="form-group">
            <label>Сортировка:</label>
            <select name="sort" onchange="this.form.submit()">
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>По рейтингу</option>
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>По названию</option>
            </select>

            <label>
                <input type="checkbox" name="order" value="1"
                       onchange="this.form.submit()" {{ request()->boolean('order') ? 'checked' : '' }}>
                Сначала старое
            </label>
        </div>
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

@endsection
