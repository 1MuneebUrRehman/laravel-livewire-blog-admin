<?php

namespace App\Http\Livewire\Front\Articles;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AllArticles extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sort = 'latest';

    protected $queryString = ['search', 'category', 'sort'];

    public function updating($field)
    {
        if (in_array($field, ['search', 'category', 'sort'])) {
            $this->resetPage();
        }
    }

    public function getArticlesProperty()
    {
        return Article::with(['category', 'user', 'tags'])
            ->published()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
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
            ->paginate(9);
    }

    public function getCategoriesProperty()
    {
        return Category::withCount([
            'articles' => function ($query) {
                $query->published();
            }
        ])->get();
    }

    public function render()
    {
        return view('livewire.front.articles.all-articles', [
            'articles'   => $this->articles,
            'categories' => $this->categories,
        ]);
    }
}