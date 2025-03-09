<div class="comment py-2" comment-id="{{ $comment['id'] }}"
     parent-comment-id="{{ $comment['parent_comment_id'] }}"
     style="margin-left: {{ $level }}px;">
    <div class="d-flex align-items-center mb-1">
        <strong>{{ $comment['user']['name'] }}</strong>
        <span class="ms-auto text-muted small">{{ date('d.m.Y', strtotime($comment['created_at']));
}}</span>
    </div>

    <div style="white-space: pre-line; word-wrap: break-word;" class="comment-content">
        {!! $comment['content'] !!}
    </div>

    <div class="d-flex align-items-start mt-1">
        <button class="btn btn-link btn-sm p-0" onclick="openReplyForm({{ $reviewId }}, {{ $comment['id'] }})">
            Send
        </button>
    </div>
</div>
@if (!empty($comment['children']))
    <div class="children-comments">
        @foreach ($comment['children'] as $child)
            @include('review.partials.comment', ['comment' => $child, 'level' => $level + 30, 'reviewId' => $review['id']])
        @endforeach
    </div>
@endif
