<?php

namespace App\Http\Livewire\Front\Home;

use App\Models\Article;
use Livewire\Component;

class Index extends Component
{
    public $featuredArticles;
    public $recentArticles;

    public function mount()
    {
        $this->featuredArticles = Article::with(['category', 'user', 'tags'])
            ->published()
            ->featured()
            ->latest()
            ->take(3)
            ->get();

        $this->recentArticles = Article::with(['category', 'user', 'tags'])
            ->published()
            ->latest()
            ->take(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.front.home.index');
    }
}