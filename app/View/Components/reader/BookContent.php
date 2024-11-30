<?php

namespace App\View\Components\reader;

use App\Models\Book;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookContent extends Component
{
    /**
     * Create a new component instance.
     */
    public $bookContent;

    public function __construct($bookContent)
    {
        $this->bookContent = $bookContent;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reader.content');
    }
}
