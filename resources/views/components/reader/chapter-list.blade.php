@foreach ($chapters as $key => $chapter)
    @if (isset($chapter['title']['p']))
        <li>
            @if (is_array($chapter['title']['p']))
                @foreach ($chapter['title']['p'] as $titlePart)
                    <strong>
                        {{ $titlePart }}
                    </strong>
                @endforeach
            @else
                <strong>
                    {{ $chapter['title']['p'] }}
                </strong>
            @endif
        </li>
    @endif

    @if (is_array($chapter))
        <x-reader.chapter-list :chapters="$chapter"/>
    @endif
@endforeach

