<?php

namespace App\Livewire\Front\Categories;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.front')]
class AllCategories extends Component
{
    public $search = '';
    public $filter = 'all';

    public function updatedSearch()
    {
        // Search is handled automatically with wire:model.live
    }

    public function updatedFilter()
    {
        // Filter is handled automatically
    }

    public function applyFilter($type)
    {
        $this->filter = $type;
    }

    public function getCategoryColor($index)
    {
        $colors = [
            'text-indigo-600' => 'bg-indigo-50 text-indigo-700',
            'text-blue-600'   => 'bg-blue-50 text-blue-700',
            'text-green-600'  => 'bg-green-50 text-green-700',
            'text-yellow-600' => 'bg-yellow-50 text-yellow-700',
            'text-red-600'    => 'bg-red-50 text-red-700',
            'text-purple-600' => 'bg-purple-50 text-purple-700',
        ];

        $colorKeys = array_keys($colors);
        return [
            'icon'  => $colorKeys[$index % count($colorKeys)],
            'badge' => $colors[$colorKeys[$index % count($colorKeys)]]
        ];
    }

    public function render()
    {
        $query = Category::withCount('articles')
            ->having('articles_count', '>', 0);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply popularity filter
        if ($this->filter === 'popular') {
            $query->orderBy('articles_count', 'desc');
        } else {
            $query->orderBy('name');
        }

        $categories  = $query->get();
        $popularTags = Tag::withCount('articles')
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->take(12)
            ->get();

        $stats = $this->getCategoryStats();

        return view('livewire.front.categories.all-categories', [
            'categories'  => $categories,
            'popularTags' => $popularTags,
            'stats'       => $stats
        ]);
    }

    public function getCategoryStats()
    {
        return [
            'total_categories' => Category::has('articles')->count(),
            'total_articles'   => Article::published()->count(),
            'most_popular'     => Category::withCount('articles')
                ->having('articles_count', '>', 0)
                ->orderBy('articles_count', 'desc')
                ->first(),
        ];
    }
}