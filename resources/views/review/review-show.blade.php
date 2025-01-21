@extends('layouts.main')

@section('content')

    <div class="card shadow-sm border-0 rounded mt-4">
        <div class="p-4">
            <div id="reviews-list" class="reviews-list mt-3">
                <div class="mb-4 row review" data-review-id="{{ $review['id'] }}">
                    <div class="d-flex align-items-center mb-2">
                        <strong>{{ $review['name'] }}</strong>
                        <span class="ms-auto text-muted">{{ $review['created_at'] }}</span>
                    </div>
                    <p><strong>Оценка:</strong> {{ $review['rating'] }}/10</p>
                    <div class="d-flex" style="white-space: pre-wrap; word-wrap: break-word;">
                        {!! $review['content'] ?? 'No content provided.' !!}
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div>
                            <span class="heart"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        </div>
                        <div class="ms-2 likes-count">
                            {{ $review['likes'] }} Likes
                        </div>
                        <button class="btn btn-link ms-auto" onclick="openReplyForm({{ $review['id'] }}, null)">
                            Ответить
                        </button>
                    </div>
                    <!-- Комментарии -->
                    <div class="ms-4 comments">
                        @include('review.partials.comments', ['comments' => $review['comments'], 'reviewId' => $review['id']])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="replyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Написать комментарий</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form method="POST" action="{{ route('comment.upload', ['review' =>  $review['id']]) }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="parent-id" name="parent_id" value="">
                        <input type="hidden" id="review-id" name="review_id" value="">
                        <div class="mb-3">
                            <label for="content" class="form-label">Комментарий</label>
                            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function openReplyForm(reviewId, parentId) {
            document.getElementById('review-id').value = reviewId;
            document.getElementById('parent-id').value = parentId;
            const modal = new bootstrap.Modal(document.getElementById('replyModal'));
            modal.show();
        }
    </script>
@endsection
