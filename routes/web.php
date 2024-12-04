<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect("/all");
});

Route::get('/all', [ArticleController::class, 'index'])->name('articles')->middleware('auth');

Route::get('/create/article/redact', [ArticleController::class,'create'])->middleware('auth');
Route::post('/create/article', [ArticleController::class,'store'])->name('create')->middleware('auth');

Route::get('/create/article/upload', [ArticleController::class,'upload'])->middleware('auth');


Route::get('/articles/{article}/edit', [ArticleController::class, 'edit' ])->name('edit')->middleware('auth');
Route::put('/articles/{article}/update', [ArticleController::class, 'update' ])->name('update')->middleware('auth');

// Route pour la recherche
Route::get('/search', [ArticleController::class, 'search' ])->name('search')->middleware('auth');


Route::delete('/articles/{article}/delete', [ArticleController::class, 'destroy' ])->name('destroy')->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::get('/login', [SessionsController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [SessionsController::class, 'authenticate'])->middleware('guest');

Route::get('/profile', [UserController::class, 'index'])->name('profile')->middleware('auth');

Route::get('/articles/{article}', [ArticleController::class, 'show'])->middleware('auth');
Route::post('/logout', [SessionsController::class, 'logout'])->name('logout')->middleware('auth');



