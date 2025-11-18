<?php

namespace App\Livewire\Front\Home;

use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.front')]
class Index extends Component
{
    public $featuredArticle;
    public $latestArticles;
    public $categories;
    public $popularArticles;

    public function mount()
    {
        $this->featuredArticle = $this->getFeaturedArticle();
        $this->latestArticles  = $this->getLatestArticles();
        $this->categories      = $this->getCategories();
        $this->popularArticles = $this->getPopularArticles();
    }

    private function getFeaturedArticle()
    {
        return Article::with(['user', 'category'])
            ->published()
            ->latest()
            ->first();
    }

    private function getLatestArticles()
    {
        return Article::with(['user', 'category'])
            ->published()
            ->latest()
            ->take(4)
            ->get();
    }

    private function getCategories()
    {
        return Category::withCount('articles')
            ->having('articles_count', '>', 0)
            ->get()
            ->map(function ($category) {
                return [
                    'name'           => $category->name,
                    'articles_count' => $category->articles_count,
                    // You can add icons and colors in your Category model or config
                ];
            });
    }

    private function getPopularArticles()
    {
        return Article::published()
            ->popular(5) // Using the popular scope with limit
            ->get()
            ->map(function ($article) {
                return [
                    'title' => $article->title,
                    'views' => $article->views, // Format as needed in the view
                    'date'  => $article->published_at?->format('M j, Y'),
                ];
            });
    }

    public function render()
    {
        return view('livewire.front.home.index');
    }
}