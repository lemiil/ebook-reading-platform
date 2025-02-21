@extends('layouts.main')

@section('title')
    {{ $title ?? 'Информация о книге' }}
@endsection

@section('content')

    <div class="book-panel">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">

                    @include('components.book.card', ['bookData' => $bookData])

                    @include('components.review.form', [
                        'userReview' => $userReview,
                        'bookId' => request('book')->id
                    ])

                    @include('components.review.list', ['reviews' => $bookData['reviews']])

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            const reviewIds = @json(collect($bookData['reviews'])->pluck('id'));

            $.ajax({
                url: '/user/reviews/likes',
                type: 'POST',
                data: {
                    review_ids: reviewIds
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    response.likedReviews.forEach(reviewId => {
                        const review = $(".review[data-review-id='" + reviewId + "']");
                        const heart = review.find(".heart");
                        heart.html('<i class="fa fa-heart" aria-hidden="true"></i>');
                        heart.addClass("liked");

                        const likesCountElement = review.find(".likes-count");
                        let currentLikes = parseInt(likesCountElement.text().replace(' Likes', '')) || 0;
                    });
                },
            });

            $(".review").on("click", ".heart", function () {
                const heart = $(this);
                const review = heart.closest(".review");
                const likesCountElement = review.find(".likes-count");
                const reviewId = review.data("review-id");

                let currentLikes = parseInt(likesCountElement.text().replace(' Likes', '')) || 0;

                if (heart.hasClass("liked")) {
                    heart.html('<i class="fa fa-heart-o" aria-hidden="true"></i>');
                    heart.removeClass("liked");
                    likesCountElement.text(`${currentLikes - 1} Likes`);
                } else {
                    heart.html('<i class="fa fa-heart" aria-hidden="true"></i>');
                    heart.addClass("liked");
                    likesCountElement.text(`${currentLikes + 1} Likes`);
                }

                $.ajax({
                    url: '/like/review/' + reviewId,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
            });
        });
    </script>
@endsection
