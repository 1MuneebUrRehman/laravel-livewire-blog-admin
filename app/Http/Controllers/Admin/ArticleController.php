<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('admin.articles.index');
    }

    public function create(): View
    {
        $categories = Category::all();
        $tags       = Tag::all();

        return view('admin.articles.create', compact('categories', 'tags'));
    }

    public function edit(Article $article): View
    {
        $categories = Category::all();
        $tags       = Tag::all();

        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }
}