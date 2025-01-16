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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['bold', 'italic', '|', 'link', 'bulletedList', 'numberedList']
            })
            .then(editor => {
                @if (!empty($userReview) && isset($userReview['content']))
                editor.setData(`{!! $userReview['content'] !!}`);
                @endif
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

                $.post('/reviews/' + reviewId + '/like', {liked: heart.hasClass('liked')});
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
