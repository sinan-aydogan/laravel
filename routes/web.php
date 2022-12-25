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




// Update Lang
Route::post('update-lang', [\App\Http\Controllers\UpdateLangController::class, 'update'])->name('update-lang');


// Test
Route::any('test',function(){
    return Inertia::render('Test');
})->name('test');

