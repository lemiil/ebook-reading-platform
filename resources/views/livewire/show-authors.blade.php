<div>
    <input type="text" wire:model.live.debounce.500ms="query" name="author"
           placeholder="Начните вводить имя автора"
           class="form-control"/>

    @if(!empty($results))
        <ul class="list-group mt-2">
            @foreach($results as $result)
                <li wire:click="selectResult({{ $result->id }})" class="list-group-item list-group-item-action">
                    {{ $result->name }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
