<?php

namespace App\Livewire;

use App\Models\Author;
use Livewire\Component;

class ShowAuthors extends Component
{
    public $query = '';
    public $authors = [];

    public function updatedQuery()
    {
        if (strlen($this->query) >= 2) {
            $this->authors = Author::where('name', 'like', '%' . $this->query . '%')->get()->toArray();
        } else {
            $this->authors = [];
        }
    }

    public function selectAuthor($name)
    {
        $this->query = $name;
        $this->clearResults();
    }

    public function clearResults()
    {
        $this->authors = [];
    }

    public function render()
    {
        return view('livewire.show-authors');
    }
}
