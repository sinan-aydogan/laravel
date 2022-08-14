<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return Inertia::render("Welcome");
})->name('home');

// Post

Route::resource('post', \App\Http\Controllers\PostController::class);
Route::post('post/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');

// Update Lang
Route::post('update-lang', [\App\Http\Controllers\UpdateLangController::class, 'update'])->name('update-lang');


// Test
Route::any('test',function(){
    return Inertia::render('Test');
})->name('test');

