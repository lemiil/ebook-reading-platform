@extends('layouts.main')

@section('title')
    Нужно добавить название сюды
@endsection


@section('content')

    <div class="book-panel">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">

                    <div class="card shadow-sm border-0 rounded">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                @if(isset($coverBASE64))
                                    <img class="img-fluid rounded" height="300px" width="200px"
                                         src="data:image/png;base64,{{ $coverBASE64 }}"
                                         alt="Book Cover">
                                @elseif(isset($cover))
                                    <img class="img-fluid rounded" height="300px" width="200px"
                                         src="{{ asset('storage/' . $cover) }}"
                                         alt="Book Cover">
                                @else
                                    <img class="img-fluid rounded" height="300px" width="200px"
                                         src="{{ asset('storage/placeholders/book-cover-placeholder_png.png') }}"
                                         alt="Book Cover">
                                @endif
                            </div>
                            <div class="col-md-8 p-4">
                                <h4 class="fw-bold">{{ $title }}</h4>
                                @foreach($authors as $author)
                                    <h5 class="text-muted">{{ $author }}</h5>
                                @endforeach

                                @if(isset($genres))
                                    <p class="text-muted">
                                        @foreach($genres as $genre)
                                            <span class="badge bg-light text-dark me-1">{{ $genre }}</span>
                                        @endforeach
                                    </p>
                                @endif
                                @if(isset($year))
                                    <p class="text-muted">
                                        <strong>Год издания:</strong> {{ $year }}
                                    </p>
                                @endif

                                @if (isset($tags))
                                    <p class="text-muted">
                                        <strong>Теги:</strong>
                                        @foreach ($tags as $tag)
                                            <span class="me-1">{{ $tag }}</span>
                                        @endforeach
                                    </p>
                                @endif

                                <strong>
                                    <div class="text-muted">
                                        Аннотация:
                                    </div>
                                </strong>
                                <div class="description text-muted mb-4">
                                    <p>{{ $description }}</p>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-primary me-1">Читать</button>
                                    <button class="btn btn-secondary me-1">Скачать</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow-sm border-0 rounded mt-4">
                        <div class="row g-0">
                            <div class="col-md-12 p-4">
                                <h3 class="fw-bold text-dark">Комментарии</h3>
                                <div class="comments-list mt-3">
                                    <h1>тут будут комменты</h1>

                                    <div class="mt-4">
                                        <form>
                                        <textarea class="form-control" rows="3"
                                                  placeholder="Написать комментарий..."></textarea>
                                            <button type="submit" class="btn btn-primary mt-3">Отправить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Custom CSS for better styling -->
        <style>
            .card img {
                max-height: 300px;
                object-fit: cover;
            }

        </style>

@endsection
