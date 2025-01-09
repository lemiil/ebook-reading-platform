@extends('layouts.main')

@section('title')
    {{ $title ?? 'Информация о книге' }}
@endsection

@section('content')

    <div class="book-panel">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">

                    <!-- Карточка книги -->
                    <div class="card shadow-sm border-0 rounded">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                @if(isset($bookData['coverBASE64']))
                                    <img class="img-fluid rounded" height="300px" width="200px"
                                         src="data:image/png;base64,{{ $coverBASE64 }}"
                                         alt="Book Cover">
                                @elseif(isset($bookData['cover']))
                                    <img class="img-fluid rounded" height="300px" width="200px"
                                         src="{{ asset('storage/' . $bookData['cover']) }}"
                                         alt="Book Cover">
                                @else
                                    <img class="img-fluid rounded" height="300px" width="200px"
                                         src="{{ asset('storage/placeholders/book-cover-placeholder_png.png') }}"
                                         alt="Book Cover">
                                @endif
                            </div>
                            <div class="col-md-8 p-4">
                                <h4 class="fw-bold">{{ $bookData['title'] }}</h4>
                                @foreach($bookData['authors'] as $author)
                                    <h5 class="text-muted">{{ $author }}</h5>
                                @endforeach

                                @if(isset($bookData['genres']))
                                    <p class="text-muted">
                                        @foreach($bookData['genres'] as $genre)
                                            <span class="badge bg-light text-dark me-1">{{ $genre }}</span>
                                        @endforeach
                                    </p>
                                @endif

                                @if(isset($bookData['year']))
                                    <p class="text-muted"><strong>Год издания:</strong> {{ $bookData['year'] }}</p>
                                @endif

                                @if(isset($bookData['rating']))
                                    @if($bookData['rating'] == 0)
                                    @else
                                        <p class="text-muted">
                                            <strong>Рейтинг:</strong> {{ number_format($bookData['rating'], 1) }}/10
                                            рейтинг нужно будет переставить
                                        </p>
                                    @endif
                                @endif

                                <strong>
                                    <div class="text-muted">Аннотация:</div>
                                </strong>
                                <div class="description text-muted mb-4">
                                    <p>{{ $bookData['description'] }}</p>
                                </div>
                                <div class="d-flex">
                                    @if($bookData['reader'])
                                        <form action="{{ route('book.reader', ['bookId' => request('book')]) }}"
                                              target="_blank">
                                            <button class="btn btn-primary me-1">Читать</button>
                                        </form>
                                    @endif
                                    @foreach($bookData['formats'] as $format)
                                        <form
                                            action="{{ route('book.download', ['bookId' => request('book'), 'format' => $format]) }}">
                                            <button class="btn btn-secondary me-1">{{ $format }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0 rounded mt-4">
                        <div class="p-4">
                            <h3 class="fw-bold text-dark">Оставить отзыв</h3>
                            <form action="{{ route('review.upload') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ request('book')->id }}">

                                <div class="d-flex flex-column gap-3">
                                    <div class="rate d-flex justify-content-center mb-3">
                                        @for ($i = 10; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                                                   required/>
                                            <label for="star{{ $i }}" title="{{ $i }} stars">{{ $i }} stars</label>
                                        @endfor
                                    </div>

                                    <div class="editor-container">
                                        <textarea id="editor" name="content" rows="5" placeholder="Написать отзыв..."
                                        ></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Отправить</button>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 rounded mt-4">
                        <div class="p-4">
                            <h3 class="fw-bold text-dark">Отзывы</h3>
                            <div class="reviews-list mt-3">
                                @if($bookData['reviews']->count() == 0)
                                    <p class="text-muted">Отзывов пока нет.</p>
                                @else
                                    @foreach($bookData['reviews'] as $review)
                                        <div class="mb-4 row border-bottom review" data-review-id="{{ $review['id'] }}">
                                            <div class="d-flex align-items-center mb-2">
                                                <strong>{{ $review['name'] }}</strong>
                                                <span
                                                    class="ms-auto text-muted">{{ $review["created_at"] }}</span>
                                            </div>
                                            <p><strong>Оценка:</strong> {{ $review['rating'] }}/10</p>
                                            <div
                                                style="white-space: pre-wrap; word-wrap: break-word;">{!! $review['content']  ?? 'No content provided.' !!}</div>
                                            <div class="d-flex align-items-start mb-3">
                                                <div>
                                                    <span class="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                                                </div>
                                                <div class="ms-2 likes-count">
                                                    {{ $review['likes'] ?? 0 }} Likes
                                                </div>
                                                <div class="ms-auto">
                                                    <a href="" class="text-muted">Open review</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                @endif
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#editor'), {
                                toolbar: ['bold', 'italic', '|', 'link', 'bulletedList', 'numberedList']
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    </script>


                    <script>
                        $(document).ready(function () {
                            $(".review").on("click", ".heart", function () {
                                const heart = $(this);
                                const review = heart.closest(".review");
                                const likesCountElement = review.find(".likes-count");
                                const reviewId = review.data("review-id");

                                let currentLikes = parseInt(likesCountElement.text()) || 0;

                                if (heart.hasClass("liked")) {
                                    heart.html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
                                    heart.removeClass("liked");
                                    likesCountElement.text(`${currentLikes - 1} Likes`);
                                } else {
                                    heart.html('<i class="fa fa-heart" aria-hidden="true"></i>');
                                    heart.addClass("liked");
                                    likesCountElement.text(`${currentLikes + 1} Likes`);
                                }

                                // Uncomment and implement the server-side handler for likes if needed
                                // $.post('/reviews/' + reviewId + '/like', { liked: heart.hasClass('liked') });
                            });
                        });

                    </script>


                    <style>

                        .fa-heart-o {
                            color: red;
                            cursor: pointer;
                        }

                        .fa-heart {
                            color: red;
                            cursor: pointer;
                        }

                        .card img {
                            max-height: 300px;
                            object-fit: cover;
                        }

                        .rate {
                            gap: 0.5rem;
                            transform: scaleX(-1);
                        }


                        .rate:not(:checked) > input {
                            position: absolute;
                            top: -9999px;
                        }

                        .rate:not(:checked) > label {
                            float: right;
                            width: 1em;
                            overflow: hidden;
                            white-space: nowrap;
                            cursor: pointer;
                            font-size: 30px;
                            color: #ccc;
                        }

                        .rate:not(:checked) > label:before {
                            content: '★ ';
                        }

                        .rate > input:checked ~ label {
                            color: #ffc700;
                        }

                        .rate:not(:checked) > label:hover,
                        .rate:not(:checked) > label:hover ~ label {
                            color: #deb217;
                        }

                        .rate > input:checked + label:hover,
                        .rate > input:checked + label:hover ~ label,
                        .rate > input:checked ~ label:hover,
                        .rate > input:checked ~ label:hover ~ label,
                        .rate > label:hover ~ input:checked ~ label {
                            color: #c59b08;
                        }
                    </style>
                </div>

@endsection
