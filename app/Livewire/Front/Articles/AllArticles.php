<?php

namespace App\Livewire\Front\Articles;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.front')]
class AllArticles extends Component
{
    public $categories;
    public $popularTags;
    public $recentArticles;

    public function mount()
    {
        $this->categories = Category::withCount('articles')
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->get();

        $this->popularTags = Tag::withCount('articles')
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        $this->recentArticles = Article::with(['user', 'category'])
            ->published()
            ->latest()
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.front.articles.all-articles');
    }
}