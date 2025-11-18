<?php

namespace App\Livewire\Front\Home;

use App\Models\Tag;
use Livewire\Component;

class TagsCloud extends Component
{
    public $tags;

    public function mount()
    {
        $this->tags = Tag::all();
    }

    public function render()
    {
        return view('livewire.front.home.tags-cloud');
    }
}