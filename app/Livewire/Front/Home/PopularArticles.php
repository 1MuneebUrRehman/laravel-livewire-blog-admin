<?php

namespace App\Livewire\Front\Home;

use App\Models\Article;
use Livewire\Component;

class PopularArticles extends Component
{
    public $articles;
    public $limit = 5;

    public function mount($limit = 5)
    {
        $this->limit    = $limit;
        $this->articles = Article::with('user')
            ->published()
            ->popular($this->limit) // Using the popular scope
            ->get();
    }

    public function render()
    {
        return view('livewire.front.home.popular-articles');
    }
}