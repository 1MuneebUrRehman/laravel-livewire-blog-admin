<?php

namespace App\Livewire\Front\Articles;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.front')]
class AllArticles extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sort = 'newest';
    public $view = 'grid';
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

    public function updatedSearch()
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

    public function toggleView($view)
    {
        $this->view = $view;
    }

    public function render()
    {
        $articles = Article::with(['user', 'category', 'tags'])
            ->published()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $this->search . '%');
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
                    'popular' => $query->orderBy('views', 'desc'),
                    'title' => $query->orderBy('title', 'asc'),
                    default => $query->latest()
                };
            })
            ->paginate(6);

        return view('livewire.front.articles.all-articles', [
            'articles' => $articles,
        ]);
    }
}