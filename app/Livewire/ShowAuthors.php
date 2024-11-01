<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Author;

// замените на вашу модель

class ShowAuthors extends Component
{
    public $query = '';
    public $results = [];
    public $selectedResult = null;

    public function updatedQuery()
    {
        if (strlen($this->query) >= 2) {
            $this->results = Author::where('name', 'like', '%' . $this->query . '%')->limit(7)->get();
        }
    }

    public function selectResult($id)
    {
        $this->selectedResult = Author::find($id);
        $this->query = $this->selectedResult->name;
        $this->results = [];
    }

    public function render()
    {
        return view('livewire.show-authors');
    }
}

