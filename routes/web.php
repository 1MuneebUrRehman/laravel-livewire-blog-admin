<?php

use App\Livewire\Front\Articles\AllArticles;
use App\Livewire\Front\Articles\SearchResults;
use App\Livewire\Front\Articles\SingleArticle;
use App\Livewire\Front\Categories\AllCategories;
use App\Livewire\Front\Categories\SingleCategory;
use App\Livewire\Front\Home\Index;
use Illuminate\Support\Facades\Route;

Route::get('/counter', \App\Livewire\Counter::class);
Route::get('/', Index::class)->name('home');
Route::get('articles', AllArticles::class)->name('articles');
Route::get('search', SearchResults::class)->name('search');
Route::get('articles/{slug}', SingleArticle::class)->name('articles.show');
Route::get('categories', AllCategories::class)->name('categories');
Route::get('categories/{slug}', SingleCategory::class)->name('category.show');


