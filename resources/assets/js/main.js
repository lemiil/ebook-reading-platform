$(document).ready(function () {
    let $search = $('#search');
    let $results = $('#results');
    let timeout = null;

    $search.on('keyup', function () {
        clearTimeout(timeout);
        let query = $(this).val();

        if (query.length < 2) {
            $results.hide();
            return;
        }

        timeout = setTimeout(function () {
            $.ajax({
                url: '{{ route("book.search") }}',
                type: 'GET',
                data: {query: query},
                success: function (data) {
                    let results = '';
                    if (data != '') {
                        data.forEach(book => {
                            let bookUrl = '{{ route("book.show", ":id") }}'.replace(':id', book.id);
                            results += `<a href="${bookUrl}"><p class="result-item" data-title="${book.title}">${book.title}</p></a>`;
                        });
                        $results.html(results).show();
                    }
                }
            });
        }, 250);
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#search, #results').length) {
            $results.hide();
        }
    });
});

///////////

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterForm');
    const booksContainer = document.getElementById('booksContainer');

    function fetchBooks() {
        const formData = new FormData(form);
        const params = new URLSearchParams(formData).toString();

        fetch(`/api/books?${params}`)
            .then(response => response.json())
            .then(data => {
                booksContainer.innerHTML = '';
                if (data.data.length === 0) {
                    booksContainer.innerHTML = '<p>Книги не найдены.</p>';
                    return;
                }
                data.data.forEach(book => {
                    booksContainer.innerHTML += `
                                <div class="book">
                                    <h3>${book.title}</h3>
                                    <p>Рейтинг: ${book.rating}</p>
                                    <p>Просмотры: ${book.views}</p>
                                </div>
                            `;
                });
            });
    }

    form.addEventListener('change', fetchBooks);
    fetchBooks();
});


document.addEventListener("DOMContentLoaded", function () {
    function formatText(element) {
        if (element.dataset.formatted) return;

        let originalText = element.innerHTML;
        let formattedText = originalText
            .replace(/(?<!\*)\*\*(.*?)\*\*(?!\*)/g, '<strong>$1</strong>')
            .replace(/(?<!\/)\/(.*?)\/(?!\/)/g, "<em>$1</em>")
            .replace(/~~(.*?)~~/g, "<del>$1</del>")
            .replace(/!(.*?)!/g, '<span class="blockquote">$1</span>')
            .replace(/\|\|(.*?)\|\|/g, '<span class="spoiler">$1</span>');

        if (formattedText !== originalText) {
            element.innerHTML = formattedText;
            element.dataset.formatted = "true";
        }
    }

    function processElements(root) {
        root.querySelectorAll("*:not(script):not(style):not(.editor-container textarea)").forEach(element => {
            if (!element.children.length) {
                formatText(element);
            }
        });
    }

    processElements(document.body);

    const observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === Node.ELEMENT_NODE) {
                    processElements(node);
                }
            });
        });
    });

    observer.observe(document.body, {childList: true, subtree: true});
});

function openReplyForm(reviewId, parentId) {
    document.getElementById('review-id').value = reviewId;
    document.getElementById('parent-id').value = parentId;
    const modal = new bootstrap.Modal(document.getElementById('replyModal'));
    modal.show();
}

const fontSizeRange = document.getElementById('font-size-range');
const lineHeightRange = document.getElementById('line-height-range');
const textColorRange = document.getElementById('chapters-text-color-input');

const chapters = document.getElementById('chapters');

fontSizeRange.addEventListener('input', function () {
    const fontSize = fontSizeRange.value + 'px';
    chapters.style.fontSize = fontSize;
});

textColorRange.addEventListener('input', function () {
    const color = textColorRange.value;
    chapters.style.color = color;
});

lineHeightRange.addEventListener('input', function () {
    const lineHeight = lineHeightRange.value;
    chapters.style.lineHeight = lineHeight;
});
/////////
