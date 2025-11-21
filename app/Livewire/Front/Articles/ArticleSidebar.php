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
        $this->categories   = $categories;
        $this->recentArticles = $recentArticles;
        $this->popularTags  = $popularTags;
        $this->selectedCategories = $selectedCategories;
        $this->selectedTags = $selectedTags;
    }

    public function toggleCategory($categorySlug)
    {
        // Toggle selection locally
        if (in_array($categorySlug, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$categorySlug]);
        } else {
            $this->selectedCategories[] = $categorySlug;
        }

        // Emit event to the parent component if needed
        $this->dispatch('categoryToggled', categorySlug: $categorySlug);
    }

    public function toggleTag($tagSlug)
    {
        // Toggle selection locally
        if (in_array($tagSlug, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tagSlug]);
        } else {
            $this->selectedTags[] = $tagSlug;
        }

        // Emit event to the parent component if needed
        $this->dispatch('tagToggled', tagSlug: $tagSlug);
    }

    public function render()
    {
        return view('livewire.front.articles.article-sidebar');
    }
}