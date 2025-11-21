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
class AllArticles extends Component
{
    use WithPagination;

    public $categories;
    public $popularTags;
    public $recentArticles;

    #[Url]
    public $search = '';

    #[Url]
    public $selectedCategories = [];

    #[Url]
    public $selectedTags = [];

    #[Url]
    public $sortBy = 'latest';

    // Add event listeners
    protected $listeners = [
        'category-selected' => 'toggleCategory',
        'tag-selected'      => 'toggleTag'
    ];

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

    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatedSelectedTags()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search             = '';
        $this->selectedCategories = [];
        $this->selectedTags       = [];
        $this->sortBy             = 'latest';
        $this->resetPage();
    }

    public function toggleCategory($categorySlug)
    {
        if (in_array($categorySlug, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$categorySlug]);
        } else {
            $this->selectedCategories[] = $categorySlug;
        }
        $this->resetPage();
    }

    public function toggleTag($tagSlug)
    {
        if (in_array($tagSlug, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tagSlug]);
        } else {
            $this->selectedTags[] = $tagSlug;
        }
        $this->resetPage();
    }

    public function removeCategory($categorySlug)
    {
        $this->selectedCategories = array_diff($this->selectedCategories, [$categorySlug]);
        $this->resetPage();
    }

    public function removeTag($tagSlug)
    {
        $this->selectedTags = array_diff($this->selectedTags, [$tagSlug]);
        $this->resetPage();
    }

    public function render()
    {
        $articles = Article::with(['user', 'category', 'tags'])
            ->published()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedCategories, function ($query) {
                $query->whereIn(
                    'category_id',
                    Category::whereIn('slug', $this->selectedCategories)->pluck('id')
                );
            })
            ->when($this->selectedTags, function ($query) {
                $query->whereHas('tags', function ($q) {
                    $q->whereIn('slug', $this->selectedTags);
                });
            })
            ->when($this->sortBy, function ($query) {
                match ($this->sortBy) {
                    'latest' => $query->latest(),
                    'oldest' => $query->oldest(),
                    'popular' => $query->orderBy('views', 'desc'),
                    default => $query->latest()
                };
            })
            ->paginate(9);

        return view('livewire.front.articles.all-articles', [
            'articles' => $articles
        ]);
    }
}