<h2>Оглавление</h2>
@foreach ($chapters as $key => $chapter)
    <li class="chapter-item">
        <a href="#chapter_{{$key}}">
            <strong>
                {!! $chapter->getTitle() !!}
            </strong>
        </a>
    </li>
@endforeach

