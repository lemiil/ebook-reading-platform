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
                                    <p class="text-muted"><strong>Год издания:</strong> {{ $year }}</p>
                                @endif

                                @if(isset($rating))
                                    <p class="text-muted"><strong>Рейтинг:</strong> {{ number_format($rating, 1) }}/10
                                    </p>
                                @endif

                                <strong>
                                    <div class="text-muted">Аннотация:</div>
                                </strong>
                                <div class="description text-muted mb-4">
                                    <p>{{ $description }}</p>
                                </div>
                                <div class="d-flex">
                                    @if($reader)
                                        <form action="{{ route('book.reader', ['bookId' => request('book')]) }}"
                                              target="_blank">
                                            <button class="btn btn-primary me-1">Читать</button>
                                        </form>
                                    @endif
                                    @foreach($formats as $format)
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
                            <h3 class="fw-bold text-dark">Отзывы</h3>
                            <div class="reviews-list mt-3">
                                @if($reviews->count() == 0)
                                    <p class="text-muted">Отзывов пока нет.</p>
                                @else
                                    @foreach($reviews as $review)
                                        <div class="mb-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <strong>{{ $review->user->name }}</strong>
                                                <span
                                                    class="ms-auto text-muted">{{ $review->created_at->format('d.m.Y') }}</span>
                                            </div>
                                            <p><strong>Оценка:</strong> {{ $review->rating }}/10</p>
                                            <p>{{ $review->content }}</p>

                                            <div class="comments-section ms-3">
                                                @foreach($review->comments as $comment)
                                                    <div class="mb-3">
                                                        <strong>{{ $comment->user->name }}</strong>
                                                        <span class="text-muted">({{ $comment->created_at->format('d.m.Y') }})</span>
                                                        <p>{{ $comment->content }}</p>
                                                    </div>
                                                @endforeach


                                                <form
                                                    action="{{ route('comment.upload', ['reviewId' => $review->id, 'userId' => Auth::id()]) }}"
                                                    method="POST" class="mt-2">
                                                    @csrf
                                                    <textarea class="form-control" rows="2"
                                                              name="content"
                                                              placeholder="Написать комментарий..."></textarea>
                                                    <button type="submit" class="btn btn-secondary btn-sm mt-2">
                                                        Отправить
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 rounded mt-4">
                        <div class="p-4">
                            <h3 class="fw-bold text-dark">Оставить отзыв</h3>
                            <form
                                action="{{ route('review.upload', ['bookId' => request('book')])}}"
                                method="POST">

                                @csrf
                                <input type="hidden" name="book_id" value="{{ request('book') }}">
                                <div class="rate mb-3">
                                    <input type="radio" id="star10" name="rating" value="10"/>
                                    <label for="star10" title="text">10 stars</label>
                                    <input type="radio" id="star9" name="rating" value="9"/>
                                    <label for="star9" title="text">9 stars</label>
                                    <input type="radio" id="star8" name="rating" value="8"/>
                                    <label for="star8" title="text">8 stars</label>
                                    <input type="radio" id="star7" name="rating" value="7"/>
                                    <label for="star7" title="text">7 stars</label>
                                    <input type="radio" id="star6" name="rating" value="6"/>
                                    <label for="star6" title="text">6 star</label>
                                    <input type="radio" id="star5" name="rating" value="5"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rating" value="4"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rating" value="3"/>
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rating" value="2"/>
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rating" value="1"/>
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="content" rows="3"
                                              placeholder="Написать отзыв..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </form>
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

            .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
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
