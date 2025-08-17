<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Articles;

Route::get('/', function () {
    return redirect('/articles');
});

Route::get('/articles', Articles::class)->name('articles.index');