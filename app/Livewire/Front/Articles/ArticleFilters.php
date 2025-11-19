<?php

namespace App\Livewire\Front\Articles;

use Livewire\Component;

class ArticleFilters extends Component
{
    public $search = '';

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function updated($property)
    {
        if ($property === 'search') {
            $this->dispatch('filters-updated', [
                'search' => $this->search
            ]);
        }
    }

    public function render()
    {
        return view('livewire.front.articles.article-filters');
    }
}