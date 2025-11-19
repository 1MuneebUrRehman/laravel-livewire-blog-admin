<?php

namespace App\Livewire\Front\Articles;

use Livewire\Component;

class ArticleCard extends Component
{
    public $article;
    public $view = 'grid';

    public function mount($article, $view = 'grid')
    {
        $this->article = $article;
        $this->view    = $view;
    }

    public function render()
    {
        return view('livewire.front.articles.article-card');
    }
}