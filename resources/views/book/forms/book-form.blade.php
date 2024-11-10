<div class="container mt-5" style="max-width: 700px; margin: auto;">
    <form onkeydown="if(event.keyCode === 13) { return false; }" action="{{ route('book.upload') }}" method="POST"
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
            <div>
                @livewire('show-authors')
            </div>
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
            <div class="tag-container" id="tag-container">
                <input type="text" class="tag-input form-control" id="tag-input" placeholder="Добавить тег">
            </div>
            <input type="hidden" name="tags" id="tags">
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

        <button type="submit" class="btn btn-primary w-100" style="max-width: 150px; margin: auto">Загрузить
        </button>
    </form>
    @if ($errors->any())
        <ul class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session()->has('bookisuploaded'))
        <p class="text-success">Книга успешно загружена. Вы молодец.</p>
    @endif
</div>
