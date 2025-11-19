<?php

namespace App\Livewire\Front\Articles;

use Livewire\Component;

class ArticleSidebar extends Component
{
    public $categories;
    public $recentArticles;
    public $popularTags;

    public function mount($categories = [], $recentArticles = [], $popularTags = [])
    {
        $this->categories     = $categories;
        $this->recentArticles = $recentArticles;
        $this->popularTags    = $popularTags;
    }

    public function render()
    {
        return view('livewire.front.articles.article-sidebar');
    }
}