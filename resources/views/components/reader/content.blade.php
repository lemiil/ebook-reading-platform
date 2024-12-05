<div>
    @foreach ($chapters as $key => $chapter)
        @if (isset($chapter['title']['p']))
            @if (is_array($chapter['title']['p']))
                @foreach ($chapter['title']['p'] as $titlePart)
                    <strong>
                        {{ $titlePart }}
                    </strong>
                    @php
                        $titlePart = '';
                    @endphp
                @endforeach
            @else
                <strong>
                    {{ $chapter['title']['p'] }}
                </strong>
                @php
                    $chapter['title']['p'] = '';
                @endphp
                {{--  i hate this--}}
            @endif
        @endif

        @if (is_array($chapter))
            <x-reader.content :chapters="$chapter"></x-reader.content>
        @else
            <p>{{ $chapter }}</p>
        @endif
    @endforeach
</div>
