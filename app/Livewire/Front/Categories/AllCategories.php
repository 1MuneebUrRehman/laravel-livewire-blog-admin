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
            [
                'icon'  => 'text-indigo-600',
                'badge' => 'bg-indigo-50 text-indigo-700 border border-indigo-100'
            ],
            [
                'icon'  => 'text-blue-600',
                'badge' => 'bg-blue-50 text-blue-700 border border-blue-100'
            ],
            [
                'icon'  => 'text-green-600',
                'badge' => 'bg-green-50 text-green-700 border border-green-100'
            ],
            [
                'icon'  => 'text-yellow-600',
                'badge' => 'bg-yellow-50 text-yellow-700 border border-yellow-100'
            ],
            [
                'icon'  => 'text-red-600',
                'badge' => 'bg-red-50 text-red-700 border border-red-100'
            ],
            [
                'icon'  => 'text-purple-600',
                'badge' => 'bg-purple-50 text-purple-700 border border-purple-100'
            ],
            [
                'icon'  => 'text-pink-600',
                'badge' => 'bg-pink-50 text-pink-700 border border-pink-100'
            ],
            [
                'icon'  => 'text-cyan-600',
                'badge' => 'bg-cyan-50 text-cyan-700 border border-cyan-100'
            ],
        ];

        return $colors[$index % count($colors)];
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
            ->take(15)
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