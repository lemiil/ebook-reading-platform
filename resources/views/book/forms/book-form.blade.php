<div class="container w-50">
    <form action="{{ route('book.upload') }}" method="POST"
          id="bookForm" enctype="multipart/form-data" class="p-4 border rounded bg-light shadow-sm">
        @csrf
        <div class="mb-3">
            <label class="form-label">
                Заполнение полей с автором, названием, жанрами и описанием не является обязательным, но
                <b>рекомендуется</b>.
                Если в книге отсутствуют необходимые метаданные, вы получите ошибку.
            </label>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" required name="title" class="form-control" id="title" maxlength="255"
                   placeholder="Введите название книги">
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label for="author" class="form-label">Автор</label>
                <a href="#" target="_blank">Добавить нового автора</a>
            </div>
            <select id="author-select" name="authors[]" multiple="multiple" class="form-control"></select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" class="form-control description" id="description" rows="4" maxlength="2048"
                      placeholder="Введите описание книги"></textarea>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Год издания</label>
            <input type="number" name="year" class="form-control" id="year" min="0" max="2100">
        </div>

        <div class="mb-3">
            <label class="form-label">Жанры</label>
            <div class="row g-2">
                @foreach($genres as $genre)
                    <div class="col-6">
                        <div class="form-check">
                            <input type="checkbox" name="genres[]" id="genre-{{ $genre->id }}"
                                   class="form-check-input"
                                   value="{{ $genre->id }}">
                            <label class="form-check-label" for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Теги</label>
            <select id="tag-select" name="tags[]" multiple="multiple" class="form-control"></select>
        </div>

        <div class="mb-3 d-flex align-items-center">
            <label for="cover" class="form-label me-3">Обложка книги</label>
            <div class="position-relative">
                <img id="blah" class="img-fluid rounded shadow"
                     style="max-width: 200px; max-height: 300px; object-fit: cover;"/>
            </div>
            <input type="file"
                   onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                   name="cover" id="cover" class="form-control ms-3" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="bookFiles" class="form-label">Загрузить файлы (FB2, EPUB, PDF)</label>
            <input type="file" required name="book[]" id="bookFiles" class="form-control" accept=".fb2,.epub,.pdf"
                   multiple>
        </div>

        <button type="submit" class="btn btn-primary w-100" style="max-width: 150px; margin: auto">Загрузить</button>
    </form>

    @if ($errors->any())
        <ul class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
    @endif

    @if (session()->has('bookisuploaded'))
        <div class="alert success">{{ session('bookisuploaded') }}</div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/ru.js"></script>

<script>

    $(document).ready(function () {
        $('#author-select').select2({
            language: 'ru',
            placeholder: {
                id: '-1',
                text: ' Начните вводить имя автора'
            },
            ajax: {
                url: '/api/authors/search',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(author => ({
                            id: author.id,
                            text: author.name
                        }))
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $('#tag-select').select2({
            language: "ru",
            tags: true,
            tokenSeparators: [','],
            createTag: function (params) {
                const term = $.trim(params.term);
                if (term.length > 32) {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newOption: true
                };
            },
            insertTag: function (data, tag) {
                if (data.length >= 20) {
                    return false;
                } else {
                    data.push(tag);
                }
            }
        });
        $('#tag-select').on('select2:select', function (e) {
            const data = $(this).select2('data');
            if (data.length > 20) {
                const lastTagId = data[data.length - 1].id;
                const tags = $(this).val();
                tags.pop();
                $(this).val(tags).trigger('change');
            }
        });


    });
</script>


</div>
