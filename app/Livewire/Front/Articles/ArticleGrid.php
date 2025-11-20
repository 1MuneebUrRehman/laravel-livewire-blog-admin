<?php

namespace App\Livewire\Front\Articles;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleGrid extends Component
{
    use WithPagination;

    public $selectedCategories = [];
    public $selectedTags = [];
    public $search = '';
    public $sortBy = 'latest';

    protected $queryString = [
        'selectedCategories' => ['except' => '', 'as' => 'categories'],
        'selectedTags'       => ['except' => '', 'as' => 'tags'],
        'search'             => ['except' => '', 'as' => 'q'],
        'sortBy'             => ['except' => 'latest'],
    ];

    public function mount()
    {
        // Listen for search updates
        $this->dispatch('searchUpdated', search: '');
    }

    public function updated($property)
    {
        if (in_array($property, ['selectedCategories', 'selectedTags', 'search', 'sortBy'])) {
            $this->resetPage();
        }
    }

    public function clearFilters()
    {
        $this->selectedCategories = [];
        $this->selectedTags       = [];
        $this->search             = '';
        $this->sortBy             = 'latest';
        $this->resetPage();
    }

    public function getArticlesProperty()
    {
        return Article::query()
            ->with(['user', 'category', 'tags'])
            ->published()
            ->when($this->selectedCategories, function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })
            ->when($this->selectedTags, function ($query) {
                $query->whereHas('tags', function ($q) {
                    $q->whereIn('tags.id', $this->selectedTags);
                });
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->sortBy === 'latest', function ($query) {
                $query->latest();
            })
            ->when($this->sortBy === 'oldest', function ($query) {
                $query->oldest();
            })
            ->when($this->sortBy === 'popular', function ($query) {
                $query->orderBy('views', 'desc');
            })
            ->paginate(9);
    }

    public function render()
    {
        return view('livewire.front.articles.article-grid', [
            'articles' => $this->articles,
        ]);
    }
}