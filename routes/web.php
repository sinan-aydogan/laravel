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
Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::resource('post', \App\Http\Controllers\PostController::class);

Route::get('yazi/{post}', function(Post $post){
    return response()->json($post);
})->name('yazi.goster');

// Temp. Routes

Route::get('product', function(){

})->name('product.index');

Route::get('raw-material', function(){
    return Inertia::render('Welcome', [
        'header' => 'Hammaddeler',
        'tableData' => User::paginate(10),
    ]);
})->name('raw-material.index');

Route::get('tool', function(){
    return Inertia::render('Welcome', [
        'header' => 'Ölçü Aletleri',
        'tableData' => User::paginate(10),
    ]);
})->name('tool.index');

Route::get('certificate', function(){
    return Inertia::render('Welcome', [
        'header' => 'Sertifikalar',
        'tableData' => User::paginate(10),
    ]);
})->name('certificate.index');

Route::get('user', function(){
    return response()->json(\App\Models\User::with('posts')->find(1));
})->name('user');

// Update Lang
Route::post('update-lang', [\App\Http\Controllers\UpdateLangController::class, 'update'])->name('update-lang');

// Test
Route::any('test',function(){
    return Inertia::render('Test');
})->name('test');

