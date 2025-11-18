<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(): View
    {
        return view('front.search.index');
    }
}