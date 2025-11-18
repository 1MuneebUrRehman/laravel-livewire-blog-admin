<?php

namespace App\Livewire\Front\Home;

use App\Models\Category;
use Livewire\Component;

class CategoriesGrid extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::withCount('articles')
            ->having('articles_count', '>', 0)
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.front.home.categories-grid');
    }
}