<?php

namespace App\Livewire\Front\Home;

use App\Models\Article;
use Livewire\Component;

class FeaturedArticle extends Component
{
    public $article;

    public function mount()
    {
        $this->article = Article::with(['user', 'category'])
            ->published()
            ->latest()->first();

        // If you want featured articles, you'll need to add a 'is_featured' column
        // or modify your query accordingly
    }

    public function like()
    {
        if ($this->article) {
            $this->article->likes()->create([
                'user_id' => auth()->id()
            ]);
            $this->article->refresh();
        }
    }

    public function render()
    {
        return view('livewire.front.home.featured-article');
    }
}