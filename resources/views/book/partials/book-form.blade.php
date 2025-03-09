<div>
    <div class="container w-50 mb-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0 rounded">
                    <form action="{{ route('book.upload') }}" method="POST"
                          id="bookForm" enctype="multipart/form-data" class="form-control">
                        @csrf
                        <div class="mb-3">
                            <br class="form-label">
                            The site has a function for parsing metadata with books. However, filling in the data
                            manually is <b>recommended</b>.
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Name</label>
                            <input type="text" name="title" class="form-control" id="title" maxlength="255"
                                   placeholder="Name" required>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="author" class="form-label">Author</label>
                                <a href="{{ route('author.upload') }}" class="text-dark" target="_blank">
                                    Add new author
                                </a>
                            </div>
                            <select id="author-select" name="authors[]" multiple required class="form-control"></select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="4"
                                      maxlength="2048" placeholder="Description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" name="year" class="form-control" id="year" min="0" max="2100">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Genres</label>
                            <div class="row g-2">
                                @foreach($genres as $genre)
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input type="checkbox" name="genres[]" id="genre-{{ $genre->id }}"
                                                   class="form-check-input" value="{{ $genre->id }}">
                                            <label class="form-check-label"
                                                   for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <select id="tag-select" name="tags[]" multiple class="form-control"></select>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <label for="cover" class="form-label me-3">Cover</label>
                            <div class="position-relative">
                                <img id="blah" class="img-fluid rounded shadow"
                                     style="max-width: 200px; max-height: 300px; object-fit: cover;"/>
                            </div>
                            <input type="file" name="cover" id="cover" class="form-control ms-3" accept="image/*"
                                   onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                        <div class="mb-3">
                            <label for="book_fb2" class="form-label">FB2</label>
                            <input type="file" id="book_fb2" class="form-control" name="book[fb2]"
                                   accept=".fb2,.zip,.xml">
                        </div>
                        <div class="mb-3">
                            <label for="book_epub" class="form-label">EPUB</label>
                            <input type="file" id="book_epub" class="form-control" name="book[epub]"
                                   accept=".epub,.zip">
                        </div>
                        <div class="mb-3">
                            <label for="book_pdf" class="form-label">PDF</label>
                            <input type="file" id="book_pdf" class="form-control" name="book[pdf]" accept=".pdf">
                        </div>

                        <button type="submit" class="btn btn-dark w-100" style="max-width: 150px; margin: auto">
                            Upload
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <ul class="container alert alert-danger mb-3 w-50">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session()->has('bookisuploaded'))
        <div class="container alert alert-success mb-3 w-50">{{ session('bookisuploaded') }}</div>
    @endif

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/ru.js"></script>

    <script>
        $(document).ready(function () {
            $('#author-select').select2({
                language: 'ru',
                placeholder: 'Author',
                ajax: {
                    url: '/api/authors/search',
                    dataType: 'json',
                    delay: 250,
                    data: params => ({query: params.term}),
                    processResults: data => ({
                        results: data.map(author => ({id: author.id, text: author.name}))
                    }),
                    cache: true
                },
                minimumInputLength: 1
            });

            $('#tag-select').select2({
                language: 'ru',
                tags: true,
                tokenSeparators: [','],
                createTag: params => {
                    const term = $.trim(params.term);
                    return term.length > 32 ? null : {id: term, text: term, newOption: true};
                },
                insertTag: (data, tag) => {
                    if (data.length < 20) data.push(tag);
                }
            }).on('select2:select', function () {
                const data = $(this).select2('data');
                if (data.length > 20) {
                    $(this).val(data.slice(0, -1).map(tag => tag.id)).trigger('change');
                }
            });
        });
    </script>
</div>
