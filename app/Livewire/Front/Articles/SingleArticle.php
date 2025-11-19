<?php

namespace App\Livewire\Front\Articles;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.front')]
class SingleArticle extends Component
{
    public $article;
    public $categories;
    public $popularTags;
    public $recentArticles;
    public $relatedArticles;

    public function mount($slug)
    {
        // Get the article by slug
        $this->article = Article::with(['user', 'category', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Get categories with articles count
        $this->categories = Category::withCount('articles')
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->get();

        // Get popular tags
        $this->popularTags = Tag::withCount('articles')
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        // Get recent articles
        $this->recentArticles = Article::with(['user', 'category'])
            ->published()
            ->where('id', '!=', $this->article->id)
            ->latest()
            ->take(3)
            ->get();

        // Get related articles (same category)
        $this->relatedArticles = Article::with(['user', 'category'])
            ->published()
            ->where('category_id', $this->article->category_id)
            ->where('id', '!=', $this->article->id)
            ->latest()
            ->take(2)
            ->get();

        // Increment view count
        $this->article->increment('views');
    }

    public function render()
    {
        return view('livewire.front.articles.single-article');
    }
}