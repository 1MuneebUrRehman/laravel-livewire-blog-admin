<?php

namespace App\Livewire\Front\Categories;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.front')]
class SingleCategory extends Component
{
    use WithPagination;

    public $category;
    public $relatedCategories;
    public $popularTags;
    public $recentArticles;
    public $viewMode = 'grid';

    public function mount($slug)
    {
        // Get the category by slug with published articles count
        $this->category = Category::where('slug', $slug)
            ->withCount([
                'articles' => function ($query) {
                    $query->published();
                }
            ])
            ->firstOrFail();

        if ($this->category->articles_count === 0) {
            abort(404, 'No published articles found in this category');
        }

        // Get related categories with published articles count
        $this->relatedCategories = Category::where('id', '!=', $this->category->id)
            ->withCount([
                'articles' => function ($query) {
                    $query->published();
                }
            ])
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->take(4)
            ->get();

        // Get popular tags with published articles count
        $this->popularTags = Tag::withCount([
            'articles' => function ($query) {
                $query->published();
            }
        ])
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->take(9)
            ->get();

        // Get recent published articles in this category
        $this->recentArticles = Article::with(['user', 'category'])
            ->where('category_id', $this->category->id)
            ->published()
            ->latest('published_at') // Ensure we're ordering by published_at
            ->take(3)
            ->get();
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
        $this->resetPage();
    }

    public function render()
    {
        $articlesQuery = Article::with(['user', 'category', 'tags'])
            ->where('category_id', $this->category->id)
            ->published();

        $articles = $articlesQuery->paginate(5);

        return view('livewire.front.categories.single-category', compact('articles'));
    }
}