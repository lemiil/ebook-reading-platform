<div class="card shadow-sm border-0 rounded mt-4">
    <div class="row g-0">
        <div class="col-md-4 d-flex justify-content-center align-items-center">
            @if(isset($bookData['coverBASE64']))
                <img class="img-fluid rounded" height="300px" width="200px"
                     src="data:image/png;base64,{{ $coverBASE64 }}"
                     alt="Book Cover">
            @elseif(isset($bookData['cover']))
                <img class="img-fluid rounded" height="300px" width="200px"
                     src="{{ asset('storage/' . $bookData['cover']) }}"
                     alt="Book Cover">
            @else
                <img class="img-fluid rounded" height="300px" width="200px"
                     src="{{ asset('storage/placeholders/book-cover-placeholder_png.png') }}"
                     alt="Book Cover">
            @endif
        </div>
        <div class="col-md-8 p-4">
            <h4 class="fw-bold">{{ $bookData['title'] }}</h4>
            @foreach($bookData['authors'] as $author)
                <h5 class="text-muted">{{ $author }}</h5>
            @endforeach

            @if(isset($bookData['genres']))
                <p class="text-muted">
                    @foreach($bookData['genres'] as $genre)
                        <span class="badge bg-light text-dark me-1">{{ $genre }}</span>
                    @endforeach
                </p>
            @endif

            @if(isset($bookData['year']))
                <p class="text-muted"><strong>Год издания:</strong> {{ $bookData['year'] }}</p>
            @endif

            @if(isset($bookData['rating']))
                @if($bookData['rating'] == 0)
                @else
                    <p class="text-muted">
                        <strong>Рейтинг:</strong> {{ number_format($bookData['rating'], 1) }}/10
                        рейтинг нужно будет переставить
                    </p>
                @endif
            @endif

            <strong>
                <div class="text-muted">Аннотация:</div>
            </strong>
            <div class="description text-muted mb-4">
                <p>{{ $bookData['description'] }}</p>
            </div>
            <div class="d-flex">
                @if($bookData['reader'])
                    <form action="{{ route('book.reader', ['bookId' => request('book')]) }}"
                          target="_blank">
                        <button class="btn btn-primary me-1">Читать</button>
                    </form>
                @endif
                @foreach($bookData['formats'] as $format)
                    <form
                        action="{{ route('book.download', ['bookId' => request('book'), 'format' => $format]) }}">
                        <button class="btn btn-secondary me-1">{{ $format }}</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
