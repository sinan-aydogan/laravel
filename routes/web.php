<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

});


Route::get('transactions', function (){
    return \App\Models\Transaction::all();
});

// Update Lang
Route::post('update-lang', [\App\Http\Controllers\UpdateLangController::class, 'update'])->name('update-lang');


// Test
Route::any('test',function(){
    return Inertia::render('Test');
})->name('test');

Route::get('file', function (){
    \Illuminate\Support\Facades\Storage::disk('s3')->put('denem.text', 'Bu bir deneme dosyası');
});

require __DIR__.'/routes.php';
