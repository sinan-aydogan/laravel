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
Route::middleware('auth:sanctum')->group(function(){

    // Dashboard
    Route::get('/', function(){
        return Inertia::render("Welcome");
    })->name('home');

    // Post
    Route::get('post', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::delete('post/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::match(['get', 'post'],'post/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::match(['get', 'post'],'post/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::get('post/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('post.show');
    Route::put('post/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::post('post', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');

});




// Update Lang
Route::post('update-lang', [\App\Http\Controllers\UpdateLangController::class, 'update'])->name('update-lang');


// Test
Route::any('test',function(){
    return Inertia::render('Test');
})->name('test');

