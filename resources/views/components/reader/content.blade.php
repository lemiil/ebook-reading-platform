<div>
    @foreach ($chapters as $key => $chapter)

        @if (is_array($chapter))
            <x-reader.content :chapters="$chapter"/>
        @else
            @if ($chapter == 'title')
                <strong>
                    @if (is_array($chapter['title']['p']))
                        @foreach ($chapter['title']['p'] as $titlePart)
                            {{ $titlePart }}
                        @endforeach
                    @else
                        {{ $chapter['title']['p'] }}
                    @endif
                </strong>
            @else
                <p>{{ $chapter }}</p>
            @endif
        @endif

    @endforeach
</div>
