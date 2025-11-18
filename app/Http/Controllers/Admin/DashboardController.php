<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'articles_count'   => Article::count(),
            'categories_count' => Category::count(),
            'tags_count'       => Tag::count(),
            'users_count'      => User::count(),
            'recent_articles'  => Article::with('category', 'user')
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}