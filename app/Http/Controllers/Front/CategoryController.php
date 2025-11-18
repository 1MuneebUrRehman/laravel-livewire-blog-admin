<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(Category $category): View
    {
        $category->load('articles.user', 'articles.tags');

        return view('front.categories.show', compact('category'));
    }
}