<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $stats = [];

    public function mount()
    {
        $this->stats = [
            'articles_count'   => Article::count(),
            'categories_count' => Category::count(),
            'tags_count'       => Tag::count(),
            'users_count'      => User::count(),
            'recent_articles'  => Article::with('category', 'user')
                ->latest()
                ->take(5)
                ->get(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard.index');
    }
}