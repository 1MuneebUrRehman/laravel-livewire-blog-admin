<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('front.articles.index');
    }

    public function show(Article $article): View
    {
        $article->load('category', 'tags', 'user', 'comments.user');

        return view('front.articles.show', compact('article'));
    }
}