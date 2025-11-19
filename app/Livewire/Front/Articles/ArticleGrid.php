<?php

namespace App\Livewire\Front\Articles;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleGrid extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sort = 'newest';
    public $view = 'grid';

    protected $listeners = ['filters-updated' => 'updateFilters'];

    public function updateFilters($filters)
    {
        $this->search   = $filters['search'];
        $this->category = $filters['category'];
        $this->sort     = $filters['sort'];
        $this->view     = $filters['view'];
        $this->resetPage();
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

        return view('livewire.front.articles.article-grid', [
            'articles' => $articles,
        ]);
    }
}