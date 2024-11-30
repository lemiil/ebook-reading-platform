<ul>
    @foreach ($chapters as $key => $chapter)
        @if (isset($chapter['title']['p']))

            <strong>
                @if (is_array($chapter['title']['p']))
                    @foreach ($chapter['title']['p'] as $titlePart)
                        {{ $titlePart }}
                    @endforeach
                @else
                    {{ $chapter['title']['p'] }}
                @endif
            </strong>

        @endif

        @if (is_array($chapter))
            <x-reader.chapter-list :chapters="$chapter"/>
        @endif
    @endforeach
</ul>
