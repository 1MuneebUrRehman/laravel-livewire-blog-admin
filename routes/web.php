<?php

use App\Livewire\Front\Articles\AllArticles;
use App\Livewire\Front\Articles\SingleArticle;
use App\Livewire\Front\Home\Index;
use Illuminate\Support\Facades\Route;

Route::get('/counter', \App\Livewire\Counter::class);
Route::get('/', Index::class)->name('home');
Route::get('articles', AllArticles::class)->name('articles');
Route::get('articles/{slug}', SingleArticle::class)->name('article.show');