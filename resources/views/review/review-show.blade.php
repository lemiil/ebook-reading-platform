@extends('layouts.main')

@section('content')

    <div class="card shadow-sm border-0 rounded mt-4">
        <div class="p-4">
            <div id="reviews-list" class="reviews-list mt-3">
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
                            <span class="heart"><i class="fa fa-heart-o"
                                                   aria-hidden="true"></i></span>
                        </div>
                        <div class="ms-2 likes-count">
                            {{ $review['likes'] }} Likes
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm border-0 rounded mt-4">
        <div class="p-4">
            <h4>Оставить комментарий</h4>
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Ваше имя</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Комментарий</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
