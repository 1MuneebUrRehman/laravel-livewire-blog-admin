<?php

namespace App\Livewire\Front\Articles;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleGrid extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = ['filters-updated' => 'updateFilters'];

    public function updateFilters($filters)
    {
        $this->search   = $filters['search'];
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
            ->paginate(6);

        return view('livewire.front.articles.article-grid', [
            'articles' => $articles,
        ]);
    }
}