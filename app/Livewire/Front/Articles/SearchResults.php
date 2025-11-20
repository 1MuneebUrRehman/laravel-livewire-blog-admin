<?php

namespace App\Livewire\Front\Articles;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.front')]
class SearchResults extends Component
{
    use WithPagination;

    #[Url]
    public $query = '';

    #[Url]
    public $category = '';

    #[Url]
    public $sort = 'relevance';

    public $categories;
    public $popularTags;
    public $recentArticles;
    public $viewMode = 'list';

    public function mount()
    {
        $this->categories = Category::withCount([
            'articles' => function ($query) {
                $query->published();
            }
        ])
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->get();

        $this->popularTags = Tag::withCount([
            'articles' => function ($query) {
                $query->published();
            }
        ])
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

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
        $this->resetPage();
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedSort()
    {
        $this->resetPage();
    }

    public function render()
    {
        $articles = Article::with(['user', 'category'])
            ->published()
            ->when($this->query, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->query . '%')
                        ->orWhere('content', 'like', '%' . $this->query . '%')
                        ->orWhere('excerpt', 'like', '%' . $this->query . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->category);
                });
            })
            ->when($this->sort, function ($query) {
                match ($this->sort) {
                    'newest' => $query->latest(),
                    'oldest' => $query->oldest(),
                    'popular' => $query->orderBy('views_count', 'desc'),
                    default => $query->latest() // relevance
                };
            })
            ->paginate(10);

        return view('livewire.front.articles.search-results', [
            'articles' => $articles,
        ]);
    }
}