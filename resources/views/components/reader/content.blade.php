<div>
    @foreach ($chapters as $key => $chapter)
        <div id="chapter_{{ $key }}" class="chapterName"><strong>{{ ($chapter->getTitle()) }}</strong></div>
        {!! ($chapter->getContent()) !!}
    @endforeach
</div>
