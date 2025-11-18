<?php

namespace App\Livewire\Front\Home;

use App\Models\Article;
use Livewire\Component;

class ArticleCard extends Component
{
    public $article;
    public $showCategory = true;

    public function mount(Article $article, $showCategory = true)
    {
        $this->article      = $article;
        $this->showCategory = $showCategory;
    }

    public function like()
    {
        // Use the like relationship instead of incrementing a non-existent column
        $this->article->likes()->create([
            'user_id' => auth()->id() // Assuming you have user authentication
        ]);
        $this->article->refresh();
    }

    public function render()
    {
        return view('livewire.front.home.article-card');
    }
}