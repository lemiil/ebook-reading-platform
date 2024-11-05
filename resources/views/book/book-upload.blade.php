@extends('layouts.main')

@section('title')
    Books Main
@endsection

@section('content')

    <form onkeydown="if(event.keyCode === 13) { return false; }" action="{{ route('book.upload') }}" method="POST"
          id="bookForm" enctype="multipart/form-data" class="p-4 border rounded bg-light shadow-sm">
        @csrf
        <div class="mb-3">
            <label class="form-label text-muted">
                Заполнение полей с автором, названием, жанрами и описанием не является обязательным, но рекомендуется.
                Если в книге отсутствуют необходимые метаданные, вы получите ошибку.
            </label>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" name="title" class="form-control" id="title" maxlength="255"
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
            <textarea name="description" class="form-control" id="description" rows="4" maxlength="2048"
                      placeholder="Введите описание книги"></textarea>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Год издания</label>
            <input type="number" name="year" class="form-control" id="year">
        </div>

        <div class="mb-3">
            <label class="form-label">Жанры</label>
            <div class="row g-3">
                @foreach($genres as $genre)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="form-check">
                            <input type="checkbox" name="genres[]" id="genre-{{ $genre->id }}" class="form-check-input"
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

        <script>
            const tagContainer = document.getElementById('tag-container');
            const tagInput = document.getElementById('tag-input');
            const tagsInput = document.getElementById('tags');
            const tags = new Set();

            tagInput.addEventListener('keyup', function (event) {
                if (event.key === 'Enter' && tagInput.value.trim() !== '') {
                    event.preventDefault();
                    const tagText = tagInput.value.trim();
                    addTag(tagText);
                    tagInput.value = '';
                }
            });

            function addTag(text) {
                if (tags.has(text)) {
                    return;
                }

                tags.add(text);
                const tag = document.createElement('tagitem');
                tag.classList.add('tag', 'd-inline-block', 'me-1', 'mb-1', 'border', 'rounded', 'p-1', 'cursor-pointer');

                const span = document.createElement('span');
                span.textContent = text;

                const removeBtn = document.createElement('span');
                removeBtn.classList.add('remove-tag', 'ms-2', 'text-danger', 'font-weight-bold');
                removeBtn.textContent = ' ×';

                tag.addEventListener('click', function () {
                    tagContainer.removeChild(tag);
                    removeTag(text);
                });

                removeBtn.addEventListener('click', function (event) {
                    event.stopPropagation();
                    tagContainer.removeChild(tag);
                    removeTag(text);
                });

                tag.appendChild(span);
                tag.appendChild(removeBtn);
                tagContainer.insertBefore(tag, tagInput);
                updateTagsInput();
            }

            function removeTag(text) {
                tags.delete(text);
                updateTagsInput();
            }

            function updateTagsInput() {
                tagsInput.value = JSON.stringify(Array.from(tags));
            }
        </script>

        <div class="mb-3">
            <label for="bookFiles" class="form-label">Upload Files (FB2, EPUB, PDF):</label>
            <input type="file" name="book[]" id="bookFiles" class="form-control" accept=".fb2,.epub,.pdf" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Загрузить</button>
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


    <style>

        .cursor-pointer {
            cursor: pointer;
        }

    </style>
    <h1 class="mt-5 text-center" style="font-size: 5em;">AMERICA YA :D</h1>

    <div class="text-center mt-3" style="white-space: pre;">
        <!-- ASCII art -->
    </div>
@endsection
