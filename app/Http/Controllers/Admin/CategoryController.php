<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index');
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }
}