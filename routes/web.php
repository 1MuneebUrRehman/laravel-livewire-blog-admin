<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/counter', \App\Livewire\Counter::class);
Route::get('/', \App\Livewire\Front\Home\Index::class)->name('home');