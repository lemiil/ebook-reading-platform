<?php

namespace App\View\Components\reader;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChapterList extends Component
{
    /**
     * Create a new component instance.
     */
    public $chapters;

    public function __construct($chapters)
    {
        $this->chapters = $chapters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reader.chapter-list');
    }
}
