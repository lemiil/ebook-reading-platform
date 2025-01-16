<div class="card shadow-sm border-0 rounded mt-4">
    <div class="p-4">
        <h3 class="fw-bold text-dark">
            {{ $userReview ? 'Редактировать отзыв' : 'Оставить отзыв' }}
        </h3>
        <form
            action="{{ $userReview ? route('review.update', ['review_id' => $userReview['id']]) : route('review.upload') }}"
            method="POST">

            @csrf
            @if(isset($userReview))
                @method('PATCH')
            @endif
            <input type="hidden" name="book_id" value="{{ request('book')->id }}">

            <div class="d-flex flex-column gap-3">
                <div class="rate d-flex justify-content-center mb-3"
                     @if($userReview) value="{{ $userReview['rating'] }}" @endif>
                    @for ($i = 10; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                               required
                            {{ $userReview && $userReview['rating'] == $i ? 'checked' : '' }}/>
                        <label for="star{{ $i }}" title="{{ $i }} stars">{{ $i }} stars</label>
                    @endfor
                </div>

                <div class="editor-container">
            <textarea id="editor" name="content" rows="5"
                      placeholder="{{ $userReview ? 'Редактировать отзыв...' : 'Написать отзыв...' }}"
            >{{ $userReview['content'] ?? '' }}</textarea>
                </div>
            </div>

            <button type="submit"
                    class="btn btn-primary mt-3">{{ $userReview ? 'Изменить' : 'Отправить' }}</button>
        </form>

    </div>
</div>
