<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        return view('admin.tags.index');
    }

    public function create(): View
    {
        return view('admin.tags.create');
    }

    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', compact('tag'));
    }
}