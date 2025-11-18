<?php

namespace App\Http\Livewire\Front\Search;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class SearchArticles extends Component
{
    use WithPagination;

    public $query = '';
    public $category = '';
    public $sort = 'latest';

    protected $queryString = ['query', 'category', 'sort'];

    public function mount()
    {
        $this->query = request('q', '');
    }

    public function updating($field)
    {
        if (in_array($field, ['query', 'category', 'sort'])) {
            $this->resetPage();
        }
    }

    public function getArticlesProperty()
    {
        return Article::with(['category', 'user', 'tags'])
            ->published()
            ->when($this->query, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->query . '%')
                        ->orWhere('content', 'like', '%' . $this->query . '%')
                        ->orWhere('excerpt', 'like', '%' . $this->query . '%')
                        ->orWhereHas('category', function ($q) {
                            $q->where('name', 'like', '%' . $this->query . '%');
                        })
                        ->orWhereHas('tags', function ($q) {
                            $q->where('name', 'like', '%' . $this->query . '%');
                        });
                });
            })
            ->when($this->category, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->category);
                });
            })
            ->when($this->sort, function ($query) {
                match ($this->sort) {
                    'oldest' => $query->oldest(),
                    'popular' => $query->orderBy('views', 'desc'),
                    default => $query->latest(),
                };
            })
            ->paginate(12);
    }

    public function getResultsCountProperty()
    {
        return $this->articles->total();
    }

    public function render()
    {
        return view('livewire.front.search.search-articles', [
            'articles' => $this->articles,
        ]);
    }
}