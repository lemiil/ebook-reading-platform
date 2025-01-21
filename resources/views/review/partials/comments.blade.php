@foreach ($comments as $comment)
    <div class="mb-3 border-bottom comment" data-comment-id="{{ $comment->id }}">
        <div class="d-flex align-items-center mb-2">
            <strong>{{ $comment->user->name }}</strong>
            <span class="ms-auto text-muted">{{ $comment->created_at->format('d.m.Y') }}</span>
        </div>
        <div style="white-space: pre-wrap; word-wrap: break-word;">
            {!! $comment['content'] !!}
        </div>
        <div class="d-flex align-items-start mt-2">
            <button class="btn btn-link" onclick="openReplyForm({{ $reviewId }}, {{ $comment['id'] }})">Ответить
            </button>
        </div>

        @if (!empty($comment['children']))
            <div class="ms-4">
                @include('review.partials.comments', ['comments' => $comment['children'], 'reviewId' => $reviewId])
            </div>
        @endif
    </div>
@endforeach
