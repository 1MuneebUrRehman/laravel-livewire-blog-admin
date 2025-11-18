<?php

namespace App\Http\Livewire\Front\Articles;

use App\Models\Article;
use Livewire\Component;

class SingleArticle extends Component
{
    public $article;

    public function mount(Article $article)
    {
        $this->article = $article;

        // Increment view count
        $article->increment('views');
    }

    public function render()
    {
        return view('livewire.front.articles.single-article', [
            'relatedArticles' => $this->getRelatedArticles(),
        ]);
    }

    private function getRelatedArticles()
    {
        return Article::with(['category', 'user'])
            ->published()
            ->where('id', '!=', $this->article->id)
            ->where(function ($query) {
                $query->where('category_id', $this->article->category_id)
                    ->orWhereHas('tags', function ($q) {
                        $q->whereIn('tags.id', $this->article->tags->pluck('id'));
                    });
            })
            ->latest()
            ->take(3)
            ->get();
    }
}