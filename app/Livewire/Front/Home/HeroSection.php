<?php

namespace App\Livewire\Front\Home;

use App\Models\Article;
use Livewire\Component;

class HeroSection extends Component
{
    public $featuredArticle;

    public function mount(): void
    {
        $this->featuredArticle = Article::with('user')
            ->published() // Use the published scope
            ->latest()
            ->first();
    }

    public function render()
    {
        return view('livewire.front.home.hero-section');
    }
}