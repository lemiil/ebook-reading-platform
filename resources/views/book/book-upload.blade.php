@extends('layouts.main')

@section('title')
    Books Main
@endsection

@section('content')

    @include('book.forms.book-form')


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
        document.getElementById('description').addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                this.value += '\n';
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
    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .form-control {
            border-radius: 0.375rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .tag {
            padding: 0.3rem 0.6rem;
            background: #e0e0e0;
            border: 1px solid #ccc;
            border-radius: 0.3rem;
        }

        .remove-tag {
            cursor: pointer;
        }
    </style>
@endsection
