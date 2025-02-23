@extends('layouts.main')

@section('title')
    Reviews
@endsection

@section('content')
    <div class="card shadow-sm border-0 rounded mt-4">
        <div class="p-4">
            <div id="reviews-list" class="reviews-list mt-3">
                @if($reviews->total() == 0)
                    <p class="text-muted">Отзывов пока нет.</p>
                @else
                    @foreach($reviews as $review)
                        <div class="mb-4 row border-bottom review" data-review-id="{{ $review['id'] }}">
                            <div class="d-flex align-items-center mb-2">
                                <strong>{{ $review->user->name }}</strong>
                                <span
                                    class="ms-auto text-muted">{{ $review["created_at"]->format('d.m.Y') }}</span>
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
                                <div class="ms-auto">
                                    <a href="" class="text-muted">Open review</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if ($reviews->hasMorePages())
                    <button id="load-more" class="btn btn-primary">Load More</button>
                @endif


            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            const loadMoreButton = $('#load-more');

            if (loadMoreButton.length) {
                loadMoreButton.on('click', function () {
                    const nextPageUrl = "{{ $reviews->nextPageUrl() }}";

                    if (nextPageUrl) {
                        $.ajax({
                            url: nextPageUrl,
                            method: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                const reviewsList = $('#reviews-list');
                                if (reviewsList.length) {
                                    data.data.forEach(function (review) {
                                        const reviewHtml = `
                        <div class="mb-4 row border-bottom review" data-review-id=" ${review.id} ">
                            <div class="d-flex align-items-center mb-2">
                                <strong>${review.name}</strong>
                                <span
                                    class="ms-auto text-muted">${review.created_at}</span>
                            </div>
                            <p><strong>Оценка:</strong> ${review.rating}/10</p>
                            <div
                                style="white-space: pre-wrap; word-wrap: break-word;">${review.content}</div>
                            <div class="d-flex align-items-start mb-3">
                                <div>
                                                <span class="heart"><i class="fa fa-heart-o"
                                                                       aria-hidden="true"></i></span>
                                </div>
                                <div class="ms-2 likes-count">
                                    ${review.likes} Likes
                                </div>
                                <div class="ms-auto">
                                    <a href="" class="text-muted">Open review</a>
                                </div>
                            </div>
                        </div>
                    `;
                                        reviewsList.append(reviewHtml);
                                    });
                                }

                                if (!data.next_page_url) {
                                    loadMoreButton.hide();
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error loading reviews:', error);
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection
