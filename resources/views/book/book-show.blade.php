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
@endsection
