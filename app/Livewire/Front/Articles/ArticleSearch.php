<?php

namespace App\Livewire\Front\Articles;

use Livewire\Component;

class ArticleSearch extends Component
{
    public $search = '';

    public function updatedSearch()
    {
        $this->dispatch('searchUpdated', search: $this->search);
    }

    public function render()
    {
        return view('livewire.front.articles.article-search');
    }
}