<?php

namespace App\Livewire\Front\Articles;

use Livewire\Component;

class ArticleCard extends Component
{
    public $article;

    public function mount($article)
    {
        $this->article = $article;
    }

    public function render()
    {
        return view('livewire.front.articles.article-card');
    }
}