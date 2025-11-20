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

    public function updatedSelectedCategories()
    {
        $this->dispatch('categoriesUpdated', categories: $this->selectedCategories);
    }

    public function updatedSelectedTags()
    {
        $this->dispatch('tagsUpdated', tags: $this->selectedTags);
    }

    public function render()
    {
        return view('livewire.front.articles.article-filters');
    }
}