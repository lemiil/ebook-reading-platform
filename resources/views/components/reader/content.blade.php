<div>
    @foreach ($chapters as $key => $chapter)
        <strong>
            @if (isset($chapter['title']['p']))
                @if(is_array($chapter['title']['p']))
                    @foreach ($chapter['title']['p'] as $titlePart)
                        {{ $titlePart }}
                    @endforeach
                @else
                    {{ $chapter['title']['p'] }}
                @endif
            @endif
        </strong>

        @if (is_array($chapter) && !isset($chapter['title']['p']))
            <x-reader.content :chapters="$chapter"></x-reader.content>
        @elseif (!is_array($chapter))
            <p>{{ $chapter }}</p>
        @endif
    @endforeach
</div>
