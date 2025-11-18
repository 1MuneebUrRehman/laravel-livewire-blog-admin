<?php

namespace App\Livewire\Front\Home;

use App\Models\Article;
use Livewire\Component;

class LatestArticles extends Component
{
    public $articles;
    public $limit = 4;

    public function mount($limit = 4)
    {
        $this->limit = $limit;
        $this->loadArticles();
    }

    public function loadArticles()
    {
        $this->articles = Article::with(['user', 'category'])
            ->published()
            ->latest()
            ->take($this->limit)
            ->get();
    }

    public function render()
    {
        return view('livewire.front.home.latest-articles');
    }
}