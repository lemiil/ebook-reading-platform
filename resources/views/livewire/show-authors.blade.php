<div class="relative">
    <input
        type="text"
        wire:model.live.debounce="query"
        placeholder="Начните вводить имя автора"
        class="form-input form-control w-full p-2 border rounded"
        wire:keydown.escape="clearResults"
        wire:keydown.tab="clearResults"
    >
    <style>
        input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
    </style>

    @if (!empty($authors))
        <div class="dropdown absolute w-full bg-white shadow-md rounded border mt-1 max-h-48 overflow-y-auto">
            @foreach ($authors as $index => $author)
                @if ($index < 10) <!-- Limit display to 7 authors -->
                <div class="dropdown-item px-4 py-2 hover:bg-gray-100 cursor-pointer">
                    <input
                        type="radio"
                        name="author"
                        id="author-{{ $author['id'] }}"
                        value="{{ $author['name'] }}"
                        wire:click="selectAuthor('{{ $author['name'] }}')"
                        class="hidden"
                    >
                    <label for="author-{{ $author['id'] }}" class="w-full">{{ $author['name'] }}</label>
                </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
