<?php

namespace App\Livewire\Front\Home;

use App\Models\Category;
use Livewire\Component;

class Footer extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::withCount('articles')
            ->having('articles_count', '>', 0)
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.front.home.footer');
    }
}