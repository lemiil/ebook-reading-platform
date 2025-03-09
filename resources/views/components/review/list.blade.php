<div class="card shadow-sm border-0 rounded mt-4">
    <div class="p-4">
        <h3 class="fw-bold text-dark">Reviews</h3>
        <div class="reviews-list mt-3">
            @if($bookData['reviews']->count() == 0)
                <p class="text-muted">There is no reviews.</p>
            @else
                @foreach($bookData['reviews'] as $review)
                    <div class="mb-4 row border-bottom review" data-review-id="{{ $review['id'] }}">
                        <div class="d-flex align-items-center mb-2">
                            <strong>{{ $review['name'] }}</strong>
                            <span
                                class="ms-auto text-muted">{{ $review["created_at"] }}</span>
                        </div>
                        <p><strong>Rating:</strong> {{ $review['rating'] }}/10</p>
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
