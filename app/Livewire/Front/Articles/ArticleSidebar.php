<?php

namespace App\Livewire\Front\Articles;

use Livewire\Component;

class ArticleSidebar extends Component
{
    public $categories;
    public $recentArticles;
    public $popularTags;
    public $selectedCategories = [];
    public $selectedTags = [];

    public function mount(
        $categories = [],
        $recentArticles = [],
        $popularTags = [],
        $selectedCategories = [],
        $selectedTags = []
    )
    {
        $this->categories         = $categories;
        $this->recentArticles = $recentArticles;
        $this->popularTags        = $popularTags;
        $this->selectedCategories = $selectedCategories;
        $this->selectedTags       = $selectedTags;
    }

    public function toggleCategory($categorySlug)
    {
        $this->dispatch('category-selected', category: $categorySlug);
    }

    public function toggleTag($tagSlug)
    {
        $this->dispatch('tag-selected', tag: $tagSlug);
    }

    public function render()
    {
        return view('livewire.front.articles.article-sidebar');
    }
}